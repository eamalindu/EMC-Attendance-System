const JsonToTable = (dataList,tableID,displayPropertyList) => {
    //access the table via querySelector
    //const table = document.querySelector('#tblEmp');

    //children 0 -> thead
    //children 1 -> tbody
    const tbody = tabledID.children[1];
    //clear the table body
    tbody.innerHTML = '';
    if(dataList.length!==0) {
        dataList.forEach((element, index) => {

            //creating a tr element
            const tr = document.createElement('tr');

            //there are seven columns in the table, so we have to create seven tds
            const tdIndex = document.createElement('td');
            //use foreach loop to add text to the created tds
            tdIndex.innerText = index + 1;
            //append the remaining tds to the tr
            tr.appendChild(tdIndex);

            displayPropertyList.forEach((ob, ind) => {
                const td = document.createElement('td');

                //if datatype is text, get the property from the displayPropertyList and use that property to get the value from the employee array
                if (ob.dataType === 'text') {
                    //template -> element[ob.displayPropertyListColumnName] = element['fullName']
                    td.innerText = element[ob.property];
                }
                if (ob.dataType === 'function') {
                    //calling the getEmployeeStatus function and passing records of employee array one by one
                    td.innerHTML = ob.property(element);
                }

                tr.appendChild(td);
            })
            //append the tr to tbody
            tbody.appendChild(tr);
        });
    }
    else{
        const tableTR = document.createElement('tr');
        const  tableTD = document.createElement('td');
        tableTD.colSpan = (displayPropertyList.length+2);
        tableTD.innerText = 'No Records Found!';
        tableTR.appendChild(tableTD)
        tbody.appendChild(tableTR);
    }
}