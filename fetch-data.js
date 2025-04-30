const getFromPHP = (phpFile, func) => {
    fetch(phpFile)
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok ' + response.statusText);
            }
            return response.json();
        })
        .then(data => {
            func(data);
        })
        .catch(error => console.error('Error fetching data:', error));
};