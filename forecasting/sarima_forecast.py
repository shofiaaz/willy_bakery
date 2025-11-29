import sys
import pandas as pd
import json
from statsmodels.tsa.statespace.sarimax import SARIMAX

if len(sys.argv) < 2:
    print(json.dumps({"error": "Missing input file"}))
    sys.exit(1)

csv_path = sys.argv[1]

try:
    df = pd.read_csv(csv_path)
    df["sale_date"] = pd.to_datetime(df["sale_date"])

    results = {}
    materials = {}

    # Check if product_name column exists
    if "product_name" in df.columns:
        for product, sub in df.groupby("product_name"):
            series = sub.groupby("sale_date")["quantity"].sum().asfreq("D").fillna(0)


            # Require at least 4 nonzero data points
            if len(series) < 4 or series.sum() == 0:
                continue

            try:
                model = SARIMAX(series, order=(1,1,1), seasonal_order=(1,1,1,7))
                res = model.fit(disp=False)
                forecast = res.forecast(steps=14)
                results[product] = {
                    "dates": forecast.index.strftime("%Y-%m-%d").tolist(),
                    "values": forecast.values.tolist()
                }
            except Exception as inner_e:
                continue  # Skip failed models
    else:
        df = df.groupby("sale_date")["quantity"].sum().asfreq("D").fillna(0)
        model = SARIMAX(df, order=(1,1,1), seasonal_order=(1,1,1,7))
        res = model.fit(disp=False)
        forecast = res.forecast(steps=14)
        results["All Products"] = {
            "dates": forecast.index.strftime("%Y-%m-%d").tolist(),
            "values": forecast.values.tolist()
        }

    output = {
        "type": "multi" if len(results) > 1 else "single",
        "forecasts": results,
        "materials": materials
    }

    print(json.dumps(output))

except Exception as e:
    print(json.dumps({"error": str(e)}))
