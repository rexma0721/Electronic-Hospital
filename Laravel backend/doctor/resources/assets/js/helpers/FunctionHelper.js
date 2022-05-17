export default class FunctionHelper {
    constructor() {}
    validateEmail(email) {
        var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return re.test(email);
    }
    currentYear() {
        var fullDate = new Date();
        let res = fullDate.getFullYear();
        return res;
    }
    currentDate() {
        var fullDate = new Date();
        let res = (fullDate.getDate()) + '-' + (fullDate.getMonth() + 1) + '-' + fullDate.getFullYear();
        return res;
    }
    monthFromNow(xMonths) {
        let fullDate = new Date();
        fullDate.setMonth(fullDate.getMonth() + xMonths);
        let res = (fullDate.getDate()) + '-' + (fullDate.getMonth() + 1) + '-' + fullDate.getFullYear();
        return res;
    }

    fistDay() {
        let date = new Date();
        let firstDay = new Date(date.getFullYear(), date.getMonth(), 1);
        let res = (firstDay.getDate()) + '-' + (firstDay.getMonth() + 1) + '-' + firstDay.getFullYear();
        return res;
    }
    lastDay() {
        let date = new Date();
        let lastDay = new Date(date.getFullYear(), date.getMonth() + 1, 0);
        let res = (lastDay.getDate()) + '-' + (lastDay.getMonth() + 1) + '-' + lastDay.getFullYear();
        return res;
    }

    addDays(input, days) {
        var result = new Date(input);
        result.setDate(result.getDate() + days);
        let res = (result.getDate()) + '-' + (result.getMonth() + 1) + '-' + result.getFullYear();
        return res;
    }

    clearString(str) {
        return str.replace(/_/g, "");
    }

    spacetoUnderScore(str) {
        return str.split(' ').join('_');
    }

    chunk(array, size) {
        var results = [];
        while (array.length) {
            results.push(array.splice(0, size));
        }
        return results;
    }
}
