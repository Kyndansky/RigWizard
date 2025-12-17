import axios from "axios";
import type { Game } from "./interfaces";

interface Response {
  successful: boolean
  message: string
}
interface UserInfoResponse extends Response{
  username: string
}

interface GameCollectionResponse extends Response{
  totalNumberOfGames:number
  games:Game[],
}

interface TagCollectionResponse extends Response{
  tags:string[],
}
const api = axios.create({
  baseURL: import.meta.env.VITE_BACKEND_API_URL,
  withCredentials: true,
});

// Make a GET request to the backend API to check if the user is logged in
export async function getIsLoggedIn(): Promise<UserInfoResponse> {
  try {
    const response = await api.get('getUserInfo.php',
      {
        headers: {
          'Content-Type': 'application/json'
        }
      }
    );

    const data = await response.data;
    const result: UserInfoResponse =
    {
      successful: data["status"] === "success" ? true : false,
      message: data["message"],
      username: data["username"]
    };
    console.log(result);
    return result;
  } catch (error) {
    console.log("error from php server:", error);
    const result: UserInfoResponse = { successful: false, message: "server error", username: "" };
    return result;
  }

}

export async function logout(): Promise<Response> {
  try {

    const response = await api.get('logout.php',
      {
        headers: {
          'Content-Type': 'application/json'
        }
      }
    );
    const data = await response.data;
    const result: Response =
    {
      successful: data["status"] === "success" ? true : false,
      message: data["message"],
    };
    return result;
  } catch (error) {
    console.log("error from php server:", error);
    const result: Response = { successful: false, message: "server error" };
    return result;

  }
}


export async function register(username: string, password: string): Promise<UserInfoResponse> {
  try {
    const credentials = { username: username, password: password };
    const response = await api.post(
      'register.php',
      credentials,
      {
        headers: {
          'Content-Type': 'application/json'
        },
      }
    );
    const data = await response.data;

    const result: UserInfoResponse =
    {
      successful: data["status"] === "success" ? true : false,
      message: data["message"],
      username: data["username"]
    };
    console.log(result);
    return result;

  } catch (error) {
    console.log("error from php server:", error);
    const result: UserInfoResponse = { successful: false, message: "server error", username: "" };
    return result;
  }
}

export async function login(username: string, password: string): Promise<UserInfoResponse> {
  try {
    const credentials = { username: username, password: password };
    const response = await api.post(
      'login.php',
      credentials,
      {
        headers: {
          'Content-Type': 'application/json'
        },
      }
    );
    const data = await response.data;

    const result: UserInfoResponse =
    {
      successful: data["status"] === "success" ? true : false,
      message: data["message"],
      username: data["username"]
    };
    console.log(result);
    return result;

  } catch (error) {
    console.log("error from php server:", error);
    const result: UserInfoResponse = { successful: false, message: "server error", username: "" };
    return result;
  }
}

//fetches some games from the store
//for now i hardcoded an array of test games since the backend file that returns the games needs to be changed
export async function getGames(/*pageNumber:number*/): Promise<GameCollectionResponse> {
  // try {
  //   const response = await api.get('getGames.php',
  //     {
  //       params:{
  //         pageNumber:pageNumber
  //       },
  //       headers: {
  //         'Content-Type': 'application/json'
  //       }
  //     }
  //   );

  //   const data = await response.data;
  //   const result: GameCollectionResponse =
  //   {
  //     successful: data["status"] === "success" ? true : false,
  //     message: data["message"],
  //     games:data["games"],
  //   };
  //   return result;
  // } catch (error) {
  //   console.log("error from php server:", error);
  //   const result: GameCollectionResponse = { successful: false, message: "server error", games:[] };
  //   return result;
  // }

  const response:GameCollectionResponse={
    successful:true,
    message:"",
    games:gameTestArray,
    totalNumberOfGames:gameTestArray.length
  }
  return response;
}
//fetches some games from the current user's library
//for now i hardcoded an array of test games since the backend file that returns the games needs to be changed
export async function getLibraryGames(pageNumber:number): Promise<GameCollectionResponse> {
  try {  
    const response = await api.post('getUserGames.php',
      pageNumber,
      {
        headers: {
          'Content-Type': 'application/json'
        }
      }
    );

    const data = await response.data;
    console.log(data);
    const result: GameCollectionResponse =
    {
      successful: data["status"] === "success" ? true : false,
      message: data["message"],
      games:data["games"],
      totalNumberOfGames:Number(["total_games"])
    };
    console.log(pageNumber);
    console.log(result);
    return result;
  } catch (error) {
    console.log("error from php server:", error);
    const result: GameCollectionResponse = { successful: false, message: "server error", games:[], totalNumberOfGames:0};
    return result;
  }
  const result: GameCollectionResponse =
    {
      successful: true,
      message: "successfully fetched games",
      games:gameTestArray,
      totalNumberOfGames:gameTestArray.length
    };
    return result;
}

const gameTestArray:Game[]=[
  {
    name:"Hollow Knight: Silksong",
    description:"Very cool game",
    imgPath:"http://localhost/progetti/imgHostateTest/silksong.jpg",
    tags:["Action","Platformer","Indie","2D","Metroidvania"]
  },
  {
    name:"Hollow Knight",
    description:"Another very cool game",
    imgPath:"http://localhost/progetti/imgHostateTest/hollowKnight.jpg",
    tags:["Action","Platformer","Indie","2D","Metroidvania"]
  },
  {
    name:"Celeste",
    description:"Another very cool game",
    imgPath:"http://localhost/progetti/imgHostateTest/celeste.png",
    tags:["Platformer","Indie","2D"]
  },
  {
    name:"Celeste",
    description:"Another very cool game",
    imgPath:"http://localhost/progetti/imgHostateTest/celeste.png",
    tags:["Platformer","Indie","2D"]
  },
  {
    name:"Celeste",
    description:"Another very cool game",
    imgPath:"http://localhost/progetti/imgHostateTest/celeste.png",
    tags:["Platformer","Indie","2D"]
  },
]

//fetches all possible tags from the backend
//for now i hardcoded an array of test tags since the backend file that returns the games needs to be changed
export async function getTags(): Promise<TagCollectionResponse> {
  // try {
  //   const response = await api.get('gettags.php',
  //     {
  //       headers: {
  //         'Content-Type': 'application/json'
  //       }
  //     }
  //   );

  //   const data = await response.data;
  //   const result: TagCollectionResponse =
  //   {
  //     successful: data["status"] === "success" ? true : false,
  //     message: data["message"],
  //     tags:data["tags"],
  //   };
  //   return result;
  // } catch (error) {
  //   console.log("error from php server:", error);
  //   const result: TagCollectionResponse = { successful: false, message: "server error", tags:[] };
  //   return result;
  // }

  const response:TagCollectionResponse={
    successful:true,
    message:"",
    tags:tags
  }
  return response;
}


const tags:string[]=["Indie","Action","Platformer","2D","3D","Shooter","Roguelike"]