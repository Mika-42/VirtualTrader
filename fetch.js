async function getData(type) {
    const response = await fetch(`get_data.php?queryType=${type}`);
    if (!response.ok) throw new Error('Network response was not ok');
    else return await response.json();
}

function setData(type, data){
    fetch('set_data.php', {
        method: 'POST',
        headers: {'Content-Type': 'application/json'},
        body: JSON.stringify(data)
    })
        .then(res => res.json())
        .then(response => {
            if(response.error) {
                alert('Error: ' + response.error);
            } else {
                alert(response.message);
            }
        })
        .catch(err => alert('Fetch error: ' + err.message));
}