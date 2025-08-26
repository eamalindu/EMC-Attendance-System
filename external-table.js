const JsonToTable = (data,tableID,propertyList) => {

    const tbody = tabledID.children[1];
    //clear the table body
    tbody.innerHTML = '';

    if(data.length!==0) {


    }
    else{
        const tableTR = document.createElement('tr');
        const  tableTD = document.createElement('td');
        tableTD.innerText = 'No Records Found!';
        tableTR.appendChild(tableTD)
        tbody.appendChild(tableTR);
    }

}