<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agenda de Contactos</title>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #4a90e2;
            --primary-hover: #357abd;
            --secondary-color: #5c6ac4;
            --danger-color: #e74c3c;
            --danger-hover: #c0392b;
            --success-color: #2ecc71;
            --warning-color: #f1c40f;
            --text-primary: #2c3e50;
            --text-secondary: #7f8c8d;
            --background-light: #f8f9fa;
            --background-main: #f0f2f5;
            --background-card: #ffffff;
            --border-color: #dee2e6;
            --shadow-sm: 0 1px 2px rgba(0,0,0,0.05);
            --shadow: 0 2px 4px rgba(0,0,0,0.1);
            --shadow-lg: 0 4px 6px rgba(0,0,0,0.1);
        }

        * { 
            margin: 0; 
            padding: 0; 
            box-sizing: border-box; 
        }

        body { 
            font-family: 'Poppins', sans-serif;
            background: var(--background-main);
            min-height: 100vh;
            padding: 1.5rem;
            color: var(--text-primary);
            line-height: 1.5;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        .container {
            max-width: 1000px;
            margin: 0 auto;
            background: var(--background-card);
            border-radius: 0.5rem;
            box-shadow: var(--shadow);
            overflow: hidden;
            transition: background-color 0.3s ease, box-shadow 0.3s ease;
        }

        header {
            background: var(--primary-color);
            color: white;
            padding: 2rem 1.5rem;
            text-align: center;
            position: relative;
            overflow: hidden;
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
        }

        .profile-area {
            position: absolute;
            top: 1rem;
            right: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            background: rgba(255, 255, 255, 0.15);
            padding: 0.5rem 1rem;
            border-radius: 2rem;
            box-shadow: var(--shadow-sm);
        }

        .profile-image {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            border: 2px solid rgba(255, 255, 255, 0.9);
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0,0,0,0.2);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            background: white;
        }

        .profile-image:hover {
            transform: scale(1.05);
            box-shadow: 0 4px 12px rgba(0,0,0,0.3);
            border-color: white;
        }

        .profile-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .profile-image:hover img {
            transform: scale(1.1);
        }

        .profile-name {
            font-size: 1rem;
            font-weight: 500;
            color: white;
            text-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
        }

        header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="rgba(255,255,255,0.1)" fill-opacity="1" d="M0,32L48,37.3C96,43,192,53,288,80C384,107,480,149,576,154.7C672,160,768,128,864,117.3C960,107,1056,117,1152,128C1248,139,1344,149,1392,154.7L1440,160L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path></svg>');
            background-size: cover;
            background-position: bottom;
            opacity: 0.6;
        }

        header h1 { 
            font-size: 2.25em; 
            margin-bottom: 0.5rem;
            font-weight: 600;
            position: relative;
        }

        header p {
            font-size: 1.1em;
            opacity: 0.9;
            position: relative;
        }

        .content { 
            padding: 2rem; 
            background: white;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0.75rem 1.5rem;
            background: var(--primary-color);
            color: white;
            text-decoration: none;
            border-radius: 0.5rem;
            border: none;
            cursor: pointer;
            font-size: 1rem;
            font-weight: 500;
            transition: all 0.2s ease;
            gap: 0.5rem;
        }

        .btn:hover { 
            background: var(--primary-hover);
            transform: translateY(-2px);
            box-shadow: var(--shadow);
        }

        .btn-danger { 
            background: var(--danger-color); 
        }

        .btn-danger:hover { 
            background: var(--danger-hover); 
        }

        .btn-small { 
            padding: 0.5rem 1rem; 
            font-size: 0.875rem; 
        }

        table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            margin-top: 1.5rem;
            background: white;
            border-radius: 0.5rem;
            overflow: hidden;
            box-shadow: var(--shadow-sm);
        }

        th, td {
            padding: 0.75rem;
            text-align: left;
            border-bottom: 1px solid var(--border-color);
        }

        th {
            background: var(--background-light);
            color: var(--primary-color);
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.875rem;
            letter-spacing: 0.05em;
        }

        tr:last-child td {
            border-bottom: none;
        }

        tr:hover { 
            background: var(--background-light);
            transition: background-color 0.2s ease;
        }

        .search-box {
            background: white;
            padding: 1rem;
            border-radius: 0.5rem;
            box-shadow: var(--shadow-sm);
            margin: 1rem 0;
            display: flex;
            gap: 1rem;
        }

        .search-box input {
            flex: 1;
            padding: 0.75rem 1rem;
            border: 2px solid var(--border-color);
            border-radius: 0.5rem;
            font-size: 1rem;
            transition: all 0.2s ease;
        }

        .search-box input:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        label {
            display: block;
            margin-bottom: 0.5rem;
            color: var(--text-primary);
            font-weight: 500;
        }

        input[type="text"],
        input[type="email"],
        input[type="tel"] {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 2px solid var(--border-color);
            border-radius: 0.5rem;
            font-size: 1rem;
            transition: all 0.2s ease;
        }

        input[type="text"]:focus,
        input[type="email"]:focus,
        input[type="tel"]:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
        }

        .favorito-icon {
            font-size: 1.5rem;
            cursor: pointer;
            text-decoration: none;
            color: var(--warning-color);
            transition: transform 0.2s ease;
        }

        .favorito-icon:hover {
            transform: scale(1.2);
        }

        .actions { 
            white-space: nowrap;
            display: flex;
            gap: 0.5rem;
            justify-content: flex-end;
        }

        .empty-state {
            text-align: center;
            padding: 4rem 2rem;
            background: var(--background-light);
            border-radius: 1rem;
            color: var(--text-secondary);
        }

        .empty-state i {
            font-size: 4rem;
            color: var(--text-secondary);
            margin-bottom: 1rem;
        }

        .empty-state h2 {
            color: var(--text-primary);
            margin-bottom: 0.5rem;
            font-weight: 600;
        }

        .empty-state p {
            color: var(--text-secondary);
            margin-bottom: 1.5rem;
        }

        /* Animaciones */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .card {
            animation: fadeIn 0.3s ease-out;
        }

        /* Responsive */
        @media (max-width: 768px) {
            body {
                padding: 1rem;
            }

            .container {
                border-radius: 0.5rem;
            }

            header {
                padding: 2rem 1rem;
            }

            header h1 {
                font-size: 2em;
            }

            .content {
                padding: 1rem;
            }

            .actions {
                flex-direction: column;
            }

            .btn-small {
                width: 100%;
            }
        }
    </style>
    </style>
</head>
<body>
    <div class="container">
        <header>
            <div class="header-content" style="flex: 1; text-align: center;">
                <h1>📱 Agenda de Contactos</h1>
                
            </div>
            <div class="profile-area">
                <div class="profile-image">
                    <img src="/agendas_contactos/img/profile.jpg" alt="Luis Ferreira" style="width: 100%; height: 100%; object-fit: cover;">
                </div>
                <span class="profile-name">Luis Ferreira</span>
            </div>
        </header>
        <div class="content">
