<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Willy Bakery - Management System</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        :root {
            --bread-50: #fdf8f3;
            --bread-100: #f7e8d9;
            --bread-200: #eed3b4;
            --bread-300: #e2b585;
            --bread-400: #d49256;
            --bread-500: #c77a3d;
            --bread-600: #b86533;
            --bread-700: #99502c;
            --bread-800: #7b4129;
            --bread-900: #643724;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Instrument Sans', sans-serif;
            background-color: var(--bread-50);
            color: var(--bread-800);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .nav-link {
            padding: 0.5rem 1rem;
            border-radius: 9999px;
            font-size: 0.875rem;
            text-decoration: none;
            transition: all 0.3s ease;
            margin-left: 0.5rem;
        }

        .nav-link.login {
            color: var(--bread-800);
            border: 1px solid transparent;
        }

        .nav-link.login:hover {
            border-color: var(--bread-300);
        }

        .nav-link.register {
            color: white;
            background-color: var(--bread-600);
            border: 1px solid var(--bread-600);
        }

        .nav-link.register:hover {
            background-color: var(--bread-700);
        }

        .main-content {
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 2rem 1rem;
        }

        .container {
            width: 100%;
            max-width: 448px;
            margin: 0 auto;
        }

        .profile-section {
            text-align: center;
            margin-bottom: 2rem;
        }

        .profile-avatar {
            width: 6rem;
            height: 6rem;
            margin: 0 auto 1rem;
            border-radius: 50%;
            overflow: hidden;
            border: 4px solid white;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            background: linear-gradient(135deg, var(--bread-700) 0%, var(--bread-900) 100%);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .profile-avatar i {
            color: white;
            font-size: 2.5rem;
        }

        .profile-name {
            font-size: 1.75rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
            color: var(--bread-800);
        }

        .profile-description {
            color: var(--bread-600);
            font-size: 1rem;
        }

        .links-section {
            margin-bottom: 2rem;
        }

        .link-card {
            background-color: white;
            border-radius: 0.75rem;
            padding: 1.25rem;
            margin-bottom: 1rem;
            border: 1px solid var(--bread-200);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            text-decoration: none;
            color: inherit;
        }

        .link-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 15px rgba(0, 0, 0, 0.1);
            border-color: var(--bread-400);
        }

        .link-icon {
            width: 2.5rem;
            height: 2.5rem;
            border-radius: 50%;
            background-color: var(--bread-100);
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 1rem;
            flex-shrink: 0;
        }

        .link-icon i {
            color: var(--bread-600);
            font-size: 1.25rem;
        }

        .link-content {
            flex: 1;
        }

        .link-title {
            font-weight: 500;
            margin-bottom: 0.25rem;
            color: var(--bread-800);
        }

        .link-description {
            font-size: 0.875rem;
            color: var(--bread-500);
        }

        .link-arrow {
            color: var(--bread-400);
            font-size: 0.875rem;
        }

        .social-section {
            display: flex;
            justify-content: center;
            gap: 1.5rem;
        }

        .social-icon {
            color: var(--bread-600);
            font-size: 1.5rem;
            transition: all 0.2s ease;
        }

        .social-icon:hover {
            color: var(--bread-800);
            transform: scale(1.1);
        }

        .footer {
            padding: 1.5rem;
            text-align: center;
            color: var(--bread-500);
            font-size: 0.875rem;
            background-color: white;
            border-top: 1px solid var(--bread-100);
        }

        @media (max-width: 480px) {
            .container {
                padding: 0 0.5rem;
            }

            .link-card {
                padding: 1rem;
            }
        }
    </style>
</head>

<body>
    <main class="main-content">
        <div class="container">
            <div class="profile-section">
                <div class="profile-avatar">
                    <i class="fas fa-bread-slice"></i>
                </div>
                <h1 class="profile-name">Willy Bakery</h1>
                <p class="profile-description">Fresh Bread & Pastries Management System</p>
            </div>

            <div class="links-section">
                <a href="{{ route('owner.login') }}" class="link-card">
                    <div class="link-icon">
                        <i class="fas fa-user-tie"></i>
                    </div>
                    <div class="link-content">
                        <h3 class="link-title">Owner Dashboard</h3>
                        <p class="link-description">Manage suppliers, purchases, and overall operations</p>
                    </div>
                    <div class="link-arrow">
                        <i class="fas fa-chevron-right"></i>
                    </div>
                </a>

                <a href="{{ route('produksi.login') }}" class="link-card">
                    <div class="link-icon">
                        <i class="fas fa-industry"></i>
                    </div>
                    <div class="link-content">
                        <h3 class="link-title">Admin Produksi</h3>
                        <p class="link-description">Manage production, inventory, and product quality</p>
                    </div>
                    <div class="link-arrow">
                        <i class="fas fa-chevron-right"></i>
                    </div>
                </a>

                <a href="#" class="link-card">
                    <div class="link-icon">
                        <i class="fas fa-truck"></i>
                    </div>
                    <div class="link-content">
                        <h3 class="link-title">Pemasok/Supplier</h3>
                        <p class="link-description">Access supplier portal and manage deliveries</p>
                    </div>
                    <div class="link-arrow">
                        <i class="fas fa-chevron-right"></i>
                    </div>
                </a>
            </div>
        </div>
    </main>

    <footer class="footer">
        <p>&copy; {{ date('Y') }} Willy Bakery. All rights reserved.</p>
    </footer>
</body>

</html>
