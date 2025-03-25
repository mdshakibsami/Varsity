import "./App.css";
import MovieCard from "./Components/MovieCard";

function App() {
  return <>
    <MovieCard movie={{title:"Black Ball", releaseDate:"May 22 2024"}}/>
    <MovieCard movie={{title:"ONE PIECE", releaseDate:"May 22 2024", url:"https://static.wikia.nocookie.net/onepiece/images/8/87/One_Piece_Anime_Logo.png/revision/latest?cb=20140921221019"}}/>
    <MovieCard movie={{title:"Solo Leveling", releaseDate:"May 22 2024"}}/>
  </>;
}

export default App;
