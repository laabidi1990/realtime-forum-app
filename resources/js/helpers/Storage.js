class Storage {

    setToken(token) {
        localStorage.setItem('token', token);
    }

    setUser(user) {
        localStorage.setItem('user', user);
    }

    getToken() {
        return localStorage.getItem('token');
    }

    getUser() {
        return localStorage.getItem('user');
    }

    store(token, user) {
        this.setToken(token);
        this.setUser(user);
    }

    clear() {
        localStorage.removeItem('token');
        localStorage.removeItem('user');
    }

}

export default Storage = new Storage();