<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Dimsumlicious')</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        :root {
            --primary: #72BF78;
            --secondary: #A0D683;
            --accent: #D3EE98;
            --highlight: #FEFF9F;
        }

        .bg-primary {
            background-color: var(--primary);
        }

        .bg-secondary {
            background-color: var(--secondary);
        }

        .bg-accent {
            background-color: var(--accent);
        }

        .bg-highlight {
            background-color: var(--highlight);
        }

        .text-primary {
            color: var(--primary);
        }

        .text-secondary {
            color: var(--secondary);
        }

        .text-accent {
            color: var(--accent);
        }

        .text-highlight {
            color: var(--highlight);
        }

        .border-primary {
            border-color: var(--primary);
        }

        .border-secondary {
            border-color: var(--secondary);
        }

        .border-accent {
            border-color: var(--accent);
        }

        .border-highlight {
            border-color: var(--highlight);
        }

        .hover\:bg-primary:hover {
            background-color: var(--primary);
        }

        .hover\:bg-secondary:hover {
            background-color: var(--secondary);
        }

        .hover\:bg-accent:hover {
            background-color: var(--accent);
        }

        .hover\:bg-highlight:hover {
            background-color: var(--highlight);
        }

        /* Animation */
        .bounce-gentle {
            animation: bounceGentle 2s infinite;
        }

        @keyframes bounceGentle {

            0%,
            20%,
            50%,
            80%,
            100% {
                transform: translateY(0);
            }

            40% {
                transform: translateY(-10px);
            }

            60% {
                transform: translateY(-5px);
            }
        }

        .card-hover {
            transition: all 0.3s ease;
        }

        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        .btn-animated {
            position: relative;
            overflow: hidden;
        }

        .btn-animated .ripple {
            position: absolute;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.5);
            transform: scale(0);
            animation: ripple-animation 0.6s ease-out;
        }

        @keyframes ripple-animation {
            to {
                transform: scale(4);
                opacity: 0;
            }
        }
    </style>
</head>

<body class="bg-gradient-to-br from-green-50 to-green-100 min-h-screen flex flex-col">

    <!-- Navbar -->
    @include('components.user.navbar')

    <!-- Main Content -->
    <main class="flex-grow">
        @yield('content')
    </main>

    <!-- Footer -->
    @include('components.user.footer')

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Card Hover Effect
            const cards = document.querySelectorAll('.card-hover');
            cards.forEach(card => {
                card.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateY(-5px) scale(1.02)';
                });
                card.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateY(0) scale(1)';
                });
            });
        });

        // Button Animation
        document.addEventListener('DOMContentLoaded', function() {
            const buttons = document.querySelectorAll('.btn-animated');
            buttons.forEach(button => {
                button.addEventListener('click', function(e) {
                    const ripple = document.createElement('span');
                    const rect = this.getBoundingClientRect();
                    const size = Math.max(rect.width, rect.height);
                    const x = e.clientX - rect.left - size / 2;
                    const y = e.clientY - rect.top - size / 2;

                    ripple.style.width = ripple.style.height = size + 'px';
                    ripple.style.left = x + 'px';
                    ripple.style.top = y + 'px';
                    ripple.classList.add('ripple');

                    this.appendChild(ripple);

                    setTimeout(() => {
                        ripple.remove();
                    }, 600);
                });
            });
        });

        // Mobile Menu Toggle
        function toggleMobileMenu() {
            const mobileMenu = document.getElementById('mobileMenu');
            mobileMenu.classList.toggle('hidden');
        }
    </script>
</body>

</html>
