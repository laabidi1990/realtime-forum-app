import User from './User';

class Exception {
    handler(error) {
        return this.isExpiredToken(error.response.data.error)
    }

    isExpiredToken(error) {
        if (error == 'Token has expired') {
            User.logOut();
        }
    }
}

export default Exception = new Exception();