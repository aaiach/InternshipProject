import env from "../env.js"

export function getAuth (user, pass) {
  return fetch(env.host + '/api/login.php', {
    method: 'POST',
    headers: {
      'Accept': 'application/json',
      'Content-Type': 'application/json',
    },
    body: JSON.stringify({
      email: user,
      password: pass
    })
  }).then((response) => {
      if (response.ok) {
        return response.json()
      }
    })
      .catch((error) => console.error(error))
}

export function verifyToken (jwt){
  return fetch(env.host + '/api/validate_token.php', {
    method: 'POST',
    headers: {
      'Accept': 'application/json',
      'Content-Type': 'application/json',
    },
    body: JSON.stringify({
      jwt: jwt
    })
  }).then((response) => {
      if (response.ok) {
        return response.json()
      }
    })
      .catch((error) => console.error(error))
}
