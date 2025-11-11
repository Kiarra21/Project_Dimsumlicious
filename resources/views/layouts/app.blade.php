<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Dimsumlicious')</title>
    
    
    <script src="https://cdn.tailwindcss.com"></script>

    <script src="https://unpkg.com/heroicons@2.0.18/24/outline/index.js" type="module"></script>
  
    <style>
        :root {
            --primary: #72BF78;
            --secondary: #A0D683;
            --accent: #D3EE98;
            --highlight: #FEFF9F;
        }
        
        .bg-primary { background-color: var(--primary); }
        .bg-secondary { background-color: var(--secondary); }
        .bg-accent { background-color: var(--accent); }
        .bg-highlight { background-color: var(--highlight); }
        
        .text-primary { color: var(--primary); }
        .text-secondary { color: var(--secondary); }
        .text-accent { color: var(--accent); }
        .text-highlight { color: var(--highlight); }
        
        .border-primary { border-color: var(--primary); }
        .border-secondary { border-color: var(--secondary); }
        .border-accent { border-color: var(--accent); }
        .border-highlight { border-color: var(--highlight); }
        
        .hover\:bg-primary:hover { background-color: var(--primary); }
        .hover\:bg-secondary:hover { background-color: var(--secondary); }
        .hover\:bg-accent:hover { background-color: var(--accent); }
        .hover\:bg-highlight:hover { background-color: var(--highlight); }
        
        
        .bounce-gentle {
            animation: bounceGentle 2s infinite;
        }
        
        @keyframes bounceGentle {
            0%, 20%, 50%, 80%, 100% {
                transform: translateY(0);
            }
            40% {
                transform: translateY(-10px);
            }
            60% {
                transform: translateY(-5px);
            }
        }
        
        .wiggle {
            animation: wiggle 1s ease-in-out infinite;
        }
        
        @keyframes wiggle {
            0%, 7% {
                transform: rotateZ(0);
            }
            15% {
                transform: rotateZ(-15deg);
            }
            20% {
                transform: rotateZ(10deg);
            }
            25% {
                transform: rotateZ(-10deg);
            }
            30% {
                transform: rotateZ(6deg);
            }
            35% {
                transform: rotateZ(-4deg);
            }
            40%, 100% {
                transform: rotateZ(0);
            }
        }
        
        .card-hover {
            transition: all 0.3s ease;
        }
        
        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body class="bg-gradient-to-br from-green-50 to-green-100 min-h-screen">

    @include('components.navbar')
   
    <main class="min-h-screen">
        @yield('content')
    </main>

    @include('components.footer')
    
  
    <script>
        document.addEventListener('DOMContentLoaded', function() {
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
    </script>
</body>
</html>
