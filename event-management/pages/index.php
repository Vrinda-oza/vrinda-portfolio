<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eventopia - Welcome</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <style>
        body {
  font-family: 'Neuton', serif;
  background-color: #E5E5E5;
  color: #4A3F3A;
  line-height: 1.8;
  margin: 0;
  padding: 0;
}

h1, h2, h3, h4, .navbar-brand {
  font-family: 'Marcellus', serif;
  font-weight: 400;
  color: #B38B8D;
  letter-spacing: 1px;
}
        .role-card {
            transition: all 0.3s ease;
            transform: translateY(0);
        }
        .role-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }
        .role-card:active {
            transform: translateY(0);
        }
    </style>
</head>
<body class="bg-gradient-to-br from-purple-50 to-blue-50 min-h-screen flex items-center justify-center">
    <div class="container mx-auto px-4 py-12">
        <div class="max-w-4xl mx-auto text-center mb-12">
            <h1 class="text-4xl md:text-5xl font-bold text-gray-800 mb-4">
                Welcome to <span class="text-pink-600">Eventopia</span>
            </h1>
            <p class="text-xl text-gray-600">
                Please select your role to continue to the login page
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            <!-- Admin Card -->
            <div class="role-card bg-white rounded-xl shadow-md overflow-hidden p-6 text-center cursor-pointer"
                 onclick="redirectToLogin('admin')">
                <div class="bg-indigo-100 w-20 h-20 mx-auto rounded-full flex items-center justify-center mb-4">
                    <i class="fas fa-user-shield text-indigo-600 text-3xl"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-800 mb-2">Administrator</h3>
                <p class="text-gray-600 mb-4">Manage the entire Eventopia platform</p>
                <button class="bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-2 px-6 rounded-full transition">
                    Login <i class="fas fa-arrow-right ml-1"></i>
                </button>
            </div>

            <!-- User Card -->
            <div class="role-card bg-white rounded-xl shadow-md overflow-hidden p-6 text-center cursor-pointer"
                 onclick="redirectToLogin('user')">
                <div class="bg-blue-100 w-20 h-20 mx-auto rounded-full flex items-center justify-center mb-4">
                    <i class="fas fa-user text-blue-600 text-3xl"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-800 mb-2">User</h3>
                <p class="text-gray-600 mb-4">Book events and manage your account</p>
                <button class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-6 rounded-full transition">
                    Login <i class="fas fa-arrow-right ml-1"></i>
                </button>
            </div>

            <!-- Vendor Card -->
            <div class="role-card bg-white rounded-xl shadow-md overflow-hidden p-6 text-center cursor-pointer"
                 onclick="redirectToLogin('vendor')">
                <div class="bg-green-100 w-20 h-20 mx-auto rounded-full flex items-center justify-center mb-4">
                    <i class="fas fa-store text-green-600 text-3xl"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-800 mb-2">Vendor</h3>
                <p class="text-gray-600 mb-4">Manage your services and bookings</p>
                <button class="bg-green-600 hover:bg-green-700 text-white font-medium py-2 px-6 rounded-full transition">
                    Login <i class="fas fa-arrow-right ml-1"></i>
                </button>
            </div>

            <!-- Event Manager Card -->
            <div class="role-card bg-white rounded-xl shadow-md overflow-hidden p-6 text-center cursor-pointer"
                 onclick="redirectToLogin('em')">
                <div class="bg-purple-100 w-20 h-20 mx-auto rounded-full flex items-center justify-center mb-4">
                    <i class="fas fa-calendar-alt text-purple-600 text-3xl"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-800 mb-2">Event Manager</h3>
                <p class="text-gray-600 mb-4">Organize and manage events</p>
                <button class="bg-purple-600 hover:bg-purple-700 text-white font-medium py-2 px-6 rounded-full transition">
                    Login <i class="fas fa-arrow-right ml-1"></i>
                </button>
            </div>
        </div>
    </div>

    <script>
        function redirectToLogin(role) {
            switch(role) {
                case 'admin':
                    window.location.href = 'AdminLogin.php';
                    break;
                case 'user':
                    window.location.href = 'home.php';
                    break;
                case 'vendor':
                    window.location.href = 'VendorLogin.php';
                    break;
                case 'em':
                    window.location.href = 'EmLogin.php';
                    break;
                default:
                    window.location.href = 'UserLogin.php';
            }
        }
    </script>
</body>
</html>