/**
 * Created with JetBrains WebStorm.
 * User: thaer
 * Date: 12/2/12
 * Time: 10:18 AM
 * To change this template use File | Settings | File Templates.
 */

var ExpensesExecution = function (options) {
    Indicator.call(this, options);
    ExpensesExecution.prototype.initObject.call(this, options);
};

ExpensesExecution.prototype = new Indicator();

ExpensesExecution.prototype.initObject = function () {

};