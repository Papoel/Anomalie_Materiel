document.addEventListener("DOMContentLoaded", function() {
    /**
     * Calcule le numéro de la semaine pour une date donnée en suivant la norme ISO-8601.
     * La semaine commence le lundi et la première semaine de l'année contient le premier jeudi.
     *
     * @param {Date} date - La date pour laquelle calculer le numéro de la semaine.
     * @returns {number} - Le numéro de la semaine.
     */
    function getWeekNumber(date) {
        // Copier la date pour ne pas modifier l'originale
        const d = new Date(Date.UTC(date.getFullYear(), date.getMonth(), date.getDate()));

        // Obtenir le jour de la semaine (dimanche = 7 au lieu de 0)
        const dayNum = d.getUTCDay() || 7;

        // Ajuster la date pour se situer au milieu de la semaine (jeudi)
        d.setUTCDate(d.getUTCDate() + 4 - dayNum);

        // Définir le début de l'année
        const yearStart = new Date(Date.UTC(d.getUTCFullYear(), 0, 1));

        // Calculer le numéro de la semaine
        return Math.ceil((((d - yearStart) / 86400000) + 1) / 7);
    }

    /**
     * Met à jour l'élément HTML contenant le numéro de la semaine.
     * Formate le numéro de la semaine sous la forme 'yyww' (2425, semaine 25 de l'année 2024).
     */
    function updateWeekNumber() {
        // Obtenir la date actuelle
        const now = new Date();

        // Obtenir le numéro de la semaine
        const weekNumber = getWeekNumber(now);

        // Obtenir les deux derniers chiffres de l'année
        const yearShort = now.getFullYear().toString().slice(-2);

        // Mettre à jour le contenu de l'élément #current-week
        const weekElement = document.querySelector('#current-week');
        if (weekElement) {
            weekElement.textContent = `${yearShort}${weekNumber.toString().padStart(2, '0')}`;
        } else {
            console.warn('Element #current-week not found.');
        }
    }

    /**
     * Met à jour l'élément HTML contenant l'heure et la date actuelles.
     * Formate la date et l'heure en français.
     */
    function updateTime() {
        // Obtenir la date et l'heure actuelles
        const now = new Date();

        // Options pour formater la date et l'heure en français
        const optionsDateTime = {
            day:     '2-digit',
            hour:    '2-digit',
            minute:  '2-digit',
            month:   'long',
            second:  '2-digit',
            weekday: 'long',
            year:    'numeric'
        };

        // Formatter la date et l'heure
        // Mettre à jour le contenu de l'élément #current-time
        const timeElement = document.getElementById('current-time');
        if (timeElement) {
            timeElement.textContent = new Intl.DateTimeFormat('fr-FR', optionsDateTime).format(now);

            // Vérifier si #current-week est vide et mettre à jour le numéro de semaine si nécessaire
            const weekElement = document.querySelector('#current-week');
            if (!weekElement.textContent.trim()) {
                updateWeekNumber();
            }
        } else {
            console.warn('Element #current-time not found.');
        }
    }

    // Mise à jour initiale de l'heure et de la date
    updateTime();

    // Mise à jour de l'heure chaque seconde
    setInterval(updateTime, 1000);
});
