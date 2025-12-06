import axios from "axios";

interface Response {
  successful: boolean
  message: string
}
interface UserInfoResponse {
  successful: boolean,
  message: string,
  username: string
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

export { getIsLoggedIn, logout, register, login };