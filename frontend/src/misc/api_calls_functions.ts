import axios from "axios";
import type { Game } from "./interfaces";

interface Response {
  successful: boolean
  message: string
}
interface UserInfoResponse {
  successful: boolean,
  message: string,
  username: string
}

interface GameCollectionResponse {
  successful: boolean,
  message: string,
  games:Game[],
}
const api = axios.create({
  baseURL: import.meta.env.VITE_BACKEND_API_URL,
  withCredentials: true,
});

// Make a GET request to the backend API to check if the user is logged in
async function getIsLoggedIn(): Promise<UserInfoResponse> {
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
    return result;
  } catch (error) {
    console.log("error from php server:", error);
    const result: UserInfoResponse = { successful: false, message: "server error", username: "" };
    return result;
  }

}

async function logout(): Promise<Response> {
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


async function register(username: string, password: string): Promise<UserInfoResponse> {
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
    return result;

  } catch (error) {
    console.log("error from php server:", error);
    const result: UserInfoResponse = { successful: false, message: "server error", username: "" };
    return result;
  }
}

async function login(username: string, password: string): Promise<UserInfoResponse> {
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
    return result;

  } catch (error) {
    console.log("error from php server:", error);
    const result: UserInfoResponse = { successful: false, message: "server error", username: "" };
    return result;
  }
}

//fetches some games from the backend (the exact games depend on the page number)
//for now i hardcoded an array of test games since the backend file that returns the games needs to be changed
export async function getGames(pageNumber:number): Promise<GameCollectionResponse> {
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
    games:gameTestArray
  }
  return response;
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

export { getIsLoggedIn, logout, register, login };