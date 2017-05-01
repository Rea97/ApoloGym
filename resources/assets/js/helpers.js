String.prototype.capitalize = function(){
    return this.replace(/\w+/g, function(a){
        return a.charAt(0).toUpperCase() + a.slice(1).toLowerCase();
    });
};

String.prototype.capitalizeFirst = function(){
    return this.charAt(0).toUpperCase() + this.slice(1).toLowerCase();
};
