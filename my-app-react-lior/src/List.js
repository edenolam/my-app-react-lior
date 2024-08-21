import './List.css';


function List() {
    let state = {
        clients: [
            {id: 1, nom: "Julien Basquin"},
            {id: 2, nom: "francois molin"},
            {id: 3, nom: "Therese le duck"},
        ]
    };
    const title = "List des clients";
    return (<div className="List">
        <div className="List-header">
            <h1>{title}</h1>
            <ul>
                {state.clients.map(client => (
                <li>
                    {client.nom}<button>x</button>
                </li>
                ))}
            </ul>
            <form action="">
                <input type="text" placeholder={title}/>
                <button>Confirmer</button>
            </form>
        </div>

    </div>);
}

export default List