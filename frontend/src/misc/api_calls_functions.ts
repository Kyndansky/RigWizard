import axios from "axios";
import {
  type UserInfoResponse,
  type RigWizardResponse,
  type GameInfoResponse,
  type TagCollectionResponse,
  type GameCollectionResponse,
  type ComputerInfoResponse,
  type CpuListResponse,
  type MotherBoardListResponse,
  type GpuListResponse,
  type RamListResponse,
  type Computer,
  type ImgsUrlsResponse as GameImgsUrlsResponse,
} from "./interfaces";

const apiAuth = axios.create({
  baseURL: import.meta.env.VITE_BACKEND_API_URL + "/auth/",
  withCredentials: true,
});

const apiGames = axios.create({
  baseURL: import.meta.env.VITE_BACKEND_API_URL + "/games/",
  withCredentials: true,
});

const apiTags = axios.create({
  baseURL: import.meta.env.VITE_BACKEND_API_URL + "/tags/",
  withCredentials: true,
});

const apiComputers = axios.create({
  baseURL: import.meta.env.VITE_BACKEND_API_URL + "/computers/",
  withCredentials: true,
});
const apiCpus = axios.create({
  baseURL: import.meta.env.VITE_BACKEND_API_URL + "/cpu/",
  withCredentials: true,
});
const apiMotherBoards = axios.create({
  baseURL: import.meta.env.VITE_BACKEND_API_URL + "/motherboard/",
  withCredentials: true,
});
const apiGpus = axios.create({
  baseURL: import.meta.env.VITE_BACKEND_API_URL + "/gpu/",
  withCredentials: true,
});
const apiRams = axios.create({
  baseURL: import.meta.env.VITE_BACKEND_API_URL + "/ram/",
  withCredentials: true,
});
// Make a GET request to the backend API to check if the user is logged in
// sends a getUserInfoRequest to the backend to get information about the user's authentication
export async function getIsLoggedIn(): Promise<UserInfoResponse> {
  try {
    const response = await apiAuth.get("getUserInfo.php", {
      headers: {
        "Content-Type": "application/json",
      },
    });

    const data = await response.data;
    const result: UserInfoResponse = {
      successful: data["status"] === "success" ? true : false,
      message: data["message"],
      username: data["username"],
    };
    return result;
  } catch (error) {
    console.log("error from php server:", error);
    const result: UserInfoResponse = {
      successful: false,
      message: "server error",
      username: "",
    };
    return result;
  }
}

//sends a logout request to the backend
export async function logout(): Promise<RigWizardResponse> {
  try {
    const response = await apiAuth.get("logout.php", {
      headers: {
        "Content-Type": "application/json",
      },
    });
    const data = await response.data;
    const result: RigWizardResponse = {
      successful: data["status"] === "success" ? true : false,
      message: data["message"],
    };
    return result;
  } catch (error) {
    console.log("error from php server:", error);
    const result: RigWizardResponse = {
      successful: false,
      message: "server error",
    };
    return result;
  }
}

//sends a register request to the backend
export async function register(
  username: string,
  password: string
): Promise<UserInfoResponse> {
  try {
    const credentials = { username: username, password: password };
    const response = await apiAuth.post("register.php", credentials, {
      headers: {
        "Content-Type": "application/json",
      },
    });
    const data = await response.data;

    const result: UserInfoResponse = {
      successful: data["status"] === "success" ? true : false,
      message: data["message"],
      username: data["username"],
    };
    return result;
  } catch (error) {
    console.log("error from php server:", error);
    const result: UserInfoResponse = {
      successful: false,
      message: "server error",
      username: "",
    };
    return result;
  }
}

//sends a login request to the backend
export async function login(
  username: string,
  password: string
): Promise<UserInfoResponse> {
  try {
    const credentials = { username: username, password: password };
    const response = await apiAuth.post("login.php", credentials, {
      headers: {
        "Content-Type": "application/json",
      },
    });
    const data = await response.data;
    const result: UserInfoResponse = {
      successful: data["status"] === "success" ? true : false,
      message: data["message"],
      username: data["username"],
    };
    return result;
  } catch (error) {
    console.log("error from php server:", error);
    const result: UserInfoResponse = {
      successful: false,
      message: "server error",
      username: "",
    };
    return result;
  }
}
//fetches some games from the current user's library
export async function getLibraryGames(indexStart: number, numOfGames: number, filters: string[] = [], searchString: string = "", includeAllFilters: boolean, signal?: AbortSignal): Promise<GameCollectionResponse> {
  try {
    const response = await apiGames.post(
      "getUserGames.php",
      {
        indexStart: indexStart,
        numOfGames: numOfGames,
        filters,
        searchString,
        includeAllFilters: includeAllFilters,
      },
      {
        signal,
        headers: {
          "Content-Type": "application/json",
        },
      }
    );

    const data = await response.data;
    const result: GameCollectionResponse = {
      successful: data["status"] === "success" ? true : false,
      message: data["message"],
      games: data["games"],
      totalNumberOfGames: data["total_games"] || 0,
    };
    return result;
  } catch (error: any) {
    if (error.name !== 'CanceledError' && error.name !== 'AbortError') {
      console.log("error from php server:", error);
    }

    const result: GameCollectionResponse = {
      successful: false,
      message: "server error",
      games: [],
      totalNumberOfGames: 0,
    };
    return result;
  }
}

export async function getShopGames(indexStart: number, numOfGames: number, filters: string[] = [], searchString: string = "", includeAllFilters: boolean, signal?: AbortSignal): Promise<GameCollectionResponse> {
  try {
    const response = await apiGames.post(
      "getGames.php",
      {
        indexStart: indexStart,
        numOfGames: numOfGames,
        filters,
        searchString,
        includeAllFilters: includeAllFilters,
      },
      {
        signal,
        headers: {
          "Content-Type": "application/json",
        },
      }
    );

    const data = await response.data;
    const result: GameCollectionResponse = {
      successful: data["status"] === "success" ? true : false,
      message: data["message"],
      games: data["games"],
      totalNumberOfGames: data["total_games"] || 0,
    };
    return result;
  } catch (error: any) {
    if (error.name !== 'CanceledError' && error.name !== 'AbortError') {
      console.log("error from php server:", error);
    }

    const result: GameCollectionResponse = {
      successful: false,
      message: "server error",
      games: [],
      totalNumberOfGames: 0,
    };
    return result;
  }
}
//fetches all possible tags from the backend
export async function getTags(): Promise<TagCollectionResponse> {
  try {
    const response = await apiTags.get("gettags.php", {
      headers: {
        "Content-Type": "application/json",
      },
    });

    const data = await response.data;
    const result: TagCollectionResponse = {
      successful: data["status"] === "success" ? true : false,
      message: data["message"],
      tags: data.tags || [],
    };
    return result;
  } catch (error) {
    console.log("error from php server:", error);
    const result: TagCollectionResponse = {
      successful: false,
      message: "server error",
      tags: [],
    };
    return result;
  }
}

//using test game data while waiting for backend file to be finished
export async function getGameInfo(gameId: number): Promise<GameInfoResponse> {
  try {
    const response = await apiGames.get("getGameInfo.php", {
      params: {
        gameId: gameId,
      },
      headers: {
        "Content-Type": "application/json",
      },
    });

    const data = await response.data;
    let result: GameInfoResponse = {
      successful: data["status"] === "success" ? true : false,
      message: data["message"],
      game: data["game"],
    };

    return result;
  } catch (error) {
    console.log("error from php server:", error);
    const result: GameInfoResponse = {
      successful: false,
      message: "server error",
    };
    return result;
  }
}

export async function getGameImgsUrls(gameId:number):Promise<GameImgsUrlsResponse>{
  try {
    const response = await apiGames.get("getGameImgsUrls.php", {
      params: {
        gameId: gameId,
      },
      headers: {
        "Content-Type": "application/json",
      },
    });

    const data = await response.data;
    let result: GameImgsUrlsResponse = {
      successful: data["status"] === "success" ? true : false,
      message: data["message"],
      imgsUrls: data["imgUrls"],
    };

    return result;
  } catch (error) {
    console.log("error from php server:", error);
    const result: GameImgsUrlsResponse = {
      successful: false,
      message: "server error",
      imgsUrls:[]
    };
    return result;
  }
}

export async function getUserPc(): Promise<ComputerInfoResponse> {

  try {
    const response = await apiComputers.get("getUserPC.php", {
      headers: {
        "Content-Type": "application/json",
      },
    });

    const data = await response.data;

    const result: ComputerInfoResponse = {
      successful: data["status"] === "success" ? true : false,
      message: data["message"],
      computer: data["computer"],
    };
    return result;
  } catch (error) {
    console.log("error from php server:", error);
    const result: ComputerInfoResponse = {
      successful: false,
      message: "server error",
    };
    return result;
  }
}

export async function getMotherboards(): Promise<MotherBoardListResponse> {
  try {
    const response = await apiMotherBoards.get("getMotherboards.php", {
      headers: {
        "Content-Type": "application/json",
      },
    });

    const data = await response.data;
    const result: MotherBoardListResponse = {
      successful: data["status"] === "success" ? true : false,
      message: data["message"],
      motherboards: data.motherboards,
    };
    return result;
  } catch (error) {
    console.log("error from php server:", error);
    const result: MotherBoardListResponse = {
      successful: false,
      message: "server error",
      motherboards: [],
    };
    return result;
  }
}
export async function getCpus(): Promise<CpuListResponse> {
  try {
    const response = await apiCpus.get("getCpus.php", {
      headers: {
        "Content-Type": "application/json",
      },
    });

    const data = await response.data;
    const result: CpuListResponse = {
      successful: data["status"] === "success" ? true : false,
      message: data["message"],
      cpus: data.cpus,
    };
    return result;
  } catch (error) {
    console.log("error from php server:", error);
    const result: CpuListResponse = {
      successful: false,
      message: "server error",
      cpus: [],
    };
    return result;
  }
}

export async function getGpus(): Promise<GpuListResponse> {
  try {
    const response = await apiGpus.get("getGpus.php", {
      headers: {
        "Content-Type": "application/json",
      },
    });

    const data = await response.data;
    const result: GpuListResponse = {
      successful: data["status"] === "success" ? true : false,
      message: data["message"],
      gpus: data.gpus,
    };
    return result;
  } catch (error) {
    console.log("error from php server:", error);
    const result: GpuListResponse = {
      successful: false,
      message: "server error",
      gpus: [],
    };
    return result;
  }
}

export async function getRams(): Promise<RamListResponse> {
  try {
    const response = await apiRams.get("getRams.php", {
      headers: {
        "Content-Type": "application/json",
      },
    });

    const data = await response.data;
    const result: RamListResponse = {
      successful: data["status"] === "success" ? true : false,
      message: data["message"],
      rams: data.rams,
    };
    return result;
  } catch (error) {
    console.log("error from php server:", error);
    const result: RamListResponse = {
      successful: false,
      message: "server error",
      rams: [],
    };
    return result;
  }
}

export async function editPcConfiguration(
  computer: Computer
): Promise<RigWizardResponse> {
  const id_ram: number = computer.ram.id;
  const id_cpu: number = computer.cpu.id;
  const id_gpu: number = computer.gpu.id;
  const id_motherboard: number = computer.motherboard.id;
  try {
    const response = await apiComputers.post("editUserPc.php", {
      id_ram,
      id_cpu,
      id_gpu,
      id_motherboard,
      headers: {
        "Content-Type": "application/json",
      },
    });

    const data = await response.data;
    const result: RigWizardResponse = {
      successful: data["status"] === "success" ? true : false,
      message: data["message"],
    };
    return result;
  } catch (error) {
    console.log("error from php server:", error);
    const result: RigWizardResponse = {
      successful: false,
      message: "server error",
    };
    return result;
  }
}

export async function addGameToLibrary(gameId: number): Promise<RigWizardResponse> {
  try {
    const response = await apiGames.get("addGameToLibrary.php", {
      params: {
        gameId: gameId,
      },
      headers: {
        "Content-Type": "application/json",
      },
    });
    const data = await response.data;
    const result: GameInfoResponse = {
      successful: data["status"] === "success" ? true : false,
      message: data["message"] || "no message from backend",
    };
    return result;
  } catch (error) {
    console.log("error from php server:", error);
    const result: GameInfoResponse = {
      successful: false,
      message: "server error",
    };
    return result;
  }
}