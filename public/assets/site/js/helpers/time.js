/** generate human time duration from seconds */
function hours_minutes_seconds_from_seconds(seconds) {
    if (seconds > 0) {
        const hours = Math.floor(seconds / 3600);
        seconds -= hours * 3600;
        const minutes = Math.floor(seconds / 60);
        seconds -= minutes * 60;
        return hours + " hours " + minutes + " minutes " + seconds + " seconds";
    }
    return "00:00:00";
}
