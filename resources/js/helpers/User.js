import Token from './Token';
import Storage from './Storage'

class User {

    login(data) {
        axios.post('/api/auth/login', data)
        .then( res => {
            this.responseAfterLogin(res);
            window.location = '/forum';
        })
        .catch( err => {
            console.log(err.response.data);
        })
    }

    responseAfterLogin(res) {
        const access_token = res.data.access_token;
        const user_name = res.data.user;

        if (Token.isValid(access_token)) {
            Storage.store(access_token, user_name);
        }
    }

    hasToken() {
        const storedToken = Storage.getToken();
        if (storedToken) {
            return Token.isValid(storedToken) ? true : this.logOut();
        }

        return false;
    }

    loggedIn() {
        return this.hasToken();
    }

    logOut() {
        Storage.clear();
    }

    name() {
        if (this.loggedIn()) {
            return Storage.getUser();
        }
    }

    id() {
        if (this.loggedIn()) {
            const payload = Token.payload(Storage.getToken());
            return payload.sub;
        }
    }

    // authorizedUser(id)
    // {
    //     return this.id() === id;
    // }

}

export default User = new User();