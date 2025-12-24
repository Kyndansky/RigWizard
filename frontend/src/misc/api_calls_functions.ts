import axios from "axios";
import type { UserInfoResponse, RigWizardResponse, GameInfoResponse, TagCollectionResponse, GameCollectionResponse, Game } from "./interfaces";

const api = axios.create({
  baseURL: import.meta.env.VITE_BACKEND_API_URL,
  withCredentials: true,
});

// Make a GET request to the backend API to check if the user is logged in
// sends a getUserInfoRequest to the backend to get information about the user's authentication
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
    return result;
  } catch (error) {
    console.log("error from php server:", error);
    const result: UserInfoResponse = { successful: false, message: "server error", username: "" };
    return result;
  }

}

//sends a logout request to the backend
export async function logout(): Promise<RigWizardResponse> {
  try {

    const response = await api.get('logout.php',
      {
        headers: {
          'Content-Type': 'application/json'
        }
      }
    );
    const data = await response.data;
    const result: RigWizardResponse =
    {
      successful: data["status"] === "success" ? true : false,
      message: data["message"],
    };
    return result;
  } catch (error) {
    console.log("error from php server:", error);
    const result: RigWizardResponse = { successful: false, message: "server error" };
    return result;

  }
}

//sends a register request to the backend
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
    return result;

  } catch (error) {
    console.log("error from php server:", error);
    const result: UserInfoResponse = { successful: false, message: "server error", username: "" };
    return result;
  }
}

//sends a login request to the backend
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
    return result;

  } catch (error) {
    console.log("error from php server:", error);
    const result: UserInfoResponse = { successful: false, message: "server error", username: "" };
    return result;
  }
}
//fetches some games from the current user's library
export async function getLibraryGames(indexStart: number, numOfGames: number, filters: string[] = [], searchString: string = ""): Promise<GameCollectionResponse> {
  try {
    const response = await api.post('getUserGames.php',
      {
        indexStart: indexStart,
        numOfGames: numOfGames,
        filters,
        searchString
      },
      {
        headers: {
          'Content-Type': 'application/json'
        }
      }
    );

    const data = await response.data;
    console.log(indexStart);
    console.log(data);
    const result: GameCollectionResponse =
    {
      successful: data["status"] === "success" ? true : false,
      message: data["message"],
      games: data["games"],
      totalNumberOfGames: data["total_games"]
    };
    return result;
  } catch (error) {
    console.log("error from php server:", error);
    const result: GameCollectionResponse = { successful: false, message: "server error", games: [], totalNumberOfGames: 0 };
    return result;
  }

}

//fetches all possible tags from the backend
export async function getTags(): Promise<TagCollectionResponse> {
  try {
    const response = await api.get('gettags.php',
      {
        headers: {
          'Content-Type': 'application/json'
        }
      }
    );

    const data = await response.data;
    const result: TagCollectionResponse =
    {
      successful: data["status"] === "success" ? true : false,
      message: data["message"],
      tags: data.tags || [],
    };
    return result;
  } catch (error) {
    console.log("error from php server:", error);
    const result: TagCollectionResponse = { successful: false, message: "server error", tags: [] };
    return result;
  }
}

//using test game data while waiting for backend file to be finished
export async function getGameInfo(gameId: number): Promise<GameInfoResponse> {
  // try {
  //   const response = await api.get('games/getGameInfo.php',
  //     {
  //       params: {
  //         gameId: gameId
  //       },
  //       headers: {
  //         'Content-Type': 'application/json'
  //       }
  //     }
  //   );

  //   const data = await response.data;
  //   console.log(data);
  //   const result: GameInfoResponse =
  //   {
  //     successful: data["status"] === "success" ? true : false,
  //     message: data["message"],
  //     game: data["game"]
  //   };
  //   return result;
  // } catch (error) {
  //   console.log("error from php server:", error);
  //   const result: GameInfoResponse = { successful: false, message: "server error" };
  //   return result;
  // }
  const result:GameInfoResponse={
    successful:true,
    message:"successfully retrieved game info",
    game:testGame

  }
  return result;
}

const testGame:Game =
{
  id_game:1,
  title:"This is the game's title",
  description:"cool game",
  imgPath:"idk",
  tags:[]
};