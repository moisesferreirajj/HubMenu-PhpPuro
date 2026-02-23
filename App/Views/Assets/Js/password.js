function togglePassword() {
    const passwordInput = document.getElementById('password');
    const eyeIcon = document.getElementById('eye-icon');

    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        eyeIcon.classList.remove('fa-eye-slash');
        eyeIcon.classList.add('fa-eye');
        } else {
            passwordInput.type = 'password';
            eyeIcon.classList.remove('fa-eye');
            eyeIcon.classList.add('fa-eye-slash');
        }
    }
        
    const container = document.querySelector('.container');
    const movingLight = document.querySelector('.moving-light');
        
    container.addEventListener('mousemove', (e) => {
        const x = e.clientX - container.getBoundingClientRect().left;
        const y = e.clientY - container.getBoundingClientRect().top;
        movingLight.style.top = `${y - 75}px`;
        movingLight.style.left = `${x - 75}px`;
    });