import axios from "axios";

export const getData = async () => {
    const data = await axios.get('http://localhost:8876/api/v1/journal')
        .then(resp => resp.data);

    let journalData = [];
    let children = [];


    for (let i = 0; i < data.length; i++) {

        for (let j = 0; j < data[i].studentList.length; j++) {
            const childrenItem = {
                key: `${i}-${j}`,
                data: {
                    name: data[i].studentList[j].value,
                    icon: 'убрать из участия'
                }
            }
            children.push(childrenItem);
        }

        // console.log(children)

        const journalItem = {
            'key': i,
            data: {
                name: data[i].name,
                id: data[i].id,
                icon: 'добавить участника',
            },
            children,
            command:()=>{
                participant:true
            }
        }
        journalData.push(journalItem);
        children = [];
    }
    // console.log(journalData);
    return journalData;
}




