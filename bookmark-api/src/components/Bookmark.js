import {useState} from "react";
import './Bookmark.css';

const apiUrl = "http://localhost:3001/api"

const Bookmark = () =>{
    const [title, setTitle] = useState();
    const [Link, setLink] = useState();


    const CreateBookMark = () => {
        if (title && Link) {
          const options = {
            method: "POST",
            body: JSON.stringify({ Link, title }),
        };
        console.log(options)
        fetch("http://localhost:3001/api/create.php", options)
    };
}


    const [websites, setWebsites] = useState([]);

    async function fetchAllBookMarks() {
        const myWebsites = []
        const response = await fetch(apiUrl + "/readAll.php");
        const bookmarks = await response.json();
        if (bookmarks && bookmarks.length > 0) {
            // create HTML elements
            for (let item of bookmarks) {
                myWebsites.push(item)
            }
        }
        setWebsites(myWebsites)
    }
    
     const deleteBookmark = (id) =>{
        const data = {"id":id};

        if(id){
            const options = {
            method: 'DELETE',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(data)
            };
            console.log("http://localhost:3001/api/delete.php")
            console.log(options)
            fetch("http://localhost:3001/api/delete.php", options)
        }
    }
    

    return(
        <div>
            <div className="adding-container">
            <label>Title</label>
            <input
                type="text"
                value={title}
                onChange={(e) => setTitle(e.target.value)}>
            </input>
            
            <label>URL</label>
            <input
                type="text"
                value={Link}
                onChange={(e) => setLink(e.target.value)}>
            </input>
            <button onClick={CreateBookMark}>Create Bookmark</button>
            </div>
            <button onClick={fetchAllBookMarks}>Update Bookmarks</button>


            <div className="bookmarks-container">
                {websites.map((book, Index) => (
                <div className="one-mark">
                    <h1><a href={book.Link} target="_blank">{book.title}</a></h1>
                    <button className="remove-bookmark"
                    onClick={() => deleteBookmark(book.id)}>remove</button>
                </div>
                ))}
                
            </div>
        </div>
        

    )
}
export default Bookmark;