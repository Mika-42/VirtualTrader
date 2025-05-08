async function getData(type) {
    const response = await fetch(`get_data.php?queryType=${type}`);
        if(!response.ok)
        {
            new Error('Network response was not ok');
        }

    const data = await response.json();
    console.log(data); //todo remove
    return data;
}

function setData(type, data){
    fetch(`set_data.php?action=${type}`, {
        method: 'POST',
        headers: {'Content-Type': 'application/json'},
        body: JSON.stringify(data)
    })
        .then(res => res.text())
        .then(response => {

            console.log('data set: ', response);

        })
        .catch(err => console.error('Fetch error: ' + err.message));
}