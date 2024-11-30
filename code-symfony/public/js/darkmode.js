// Darkmode

const darkModeIcon = '/images/darkmode.svg';
const lightModeIcon = '/images/lightmode.svg';
const darkModeClass = 'dark-mode';
let icon = darkModeIcon;
let iconAlt = 'Mode sombre';

function updateButtonIcon(button) {
    if (document.body.classList.contains(darkModeClass)) {
        icon = lightModeIcon;
        iconAlt = 'Mode clair';
    } else {
        icon = darkModeIcon;
        iconAlt = 'Mode sombre';
    }

    button.querySelector('img').src = icon;
    button.querySelector('img').alt = iconAlt;
}

function toggleDarkMode(button) {
    document.body.classList.toggle(darkModeClass);
    if (document.body.classList.contains(darkModeClass)) {
        localStorage.setItem('theme', 'dark');
    } else {
        localStorage.setItem('theme', 'light');
    }
    updateButtonIcon(button);
}

function initializeDarkMode(button) {
    const savedTheme = localStorage.getItem('theme');
    if (savedTheme === 'dark') {
        document.body.classList.add(darkModeClass);
    }
    updateButtonIcon(button);
}


document.addEventListener('DOMContentLoaded', () => {
    const darkModeButton = document.querySelector('.darkmode-icon a');
    if (darkModeButton) {
        initializeDarkMode(darkModeButton);
        darkModeButton.addEventListener('click', (event) => {
            event.preventDefault();
            toggleDarkMode(darkModeButton);
        });
    }
});
