import axios from "axios";

const api = axios.create({
  baseURL: import.meta.env.VITE_BACKEND_API_URL,
  withCredentials: true,
});

// Make a GET request to the backend API to check if the user is logged in
async function getIsLoggedIn(): Promise<boolean> {
  try {

    const response = await api.get('getUserInfo.php',
      {
        headers: {
          'Content-Type': 'application/json'
        }
      }
    );

    const data = await response.data;

    if (data["status"] === "error") {
      return false;
    }
    return true;
  } catch (error) {
    console.log("error from php server:", error);
    return false;
  }

}

async function logout(): Promise<boolean> {
  try {

    const response = await api.get('logout.php',
      {
        headers: {
          'Content-Type': 'application/json'
        }
      }
    );
    const data = await response.data;
    console.log(data);
    if (data["status"] === "error") {
      return false;
    }
    return true;
  } catch (error) {
    console.log("error from php server:", error);
    return false;
  }
}


async function register(username: string, password: string): Promise<boolean> {
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
    console.log(data);
    if (data["status"] === "error") {
      return false;
    }
    return true;
  } catch (error) {
    console.log("error from php server:", error);
    return false;
  }
}

async function login(username: string, password: string): Promise<boolean> {
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
    console.log(data);
    if (data["status"] === "error") {
      return false;
    }
    return true;
  } catch (error) {
    console.log("error from php server:", error);
    return false;
  }
}

export { getIsLoggedIn, logout, register, login };