var VehiclePrototype = {
    getBrand: function(){
        return this.brand;
    },
    getVehicleType: function () {
        return this.vehicleType;
    }
};

function Truck(brand) {
    brand = brand || '';
    var vehicleType = 'Truck';

    function Constructor(brand, vehicleType) {
        this.brand = brand;
        this.vehicleType = vehicleType;
    }

    Constructor.prototype = VehiclePrototype;
    return new Constructor(brand, vehicleType);
}

function SUV(brand) {
    brand = brand || '';
    var vehicleType = 'SUV';

    function Constructor(brand, vehicleType) {
        this.brand = brand;
        this.vehicleType = vehicleType;
    }

    Constructor.prototype = VehiclePrototype;
    return new Constructor(brand, vehicleType);
}

// usage
var iveco = Truck('Iveco');
console.log(iveco.getBrand()); // Iveco
console.log(iveco.getVehicleType()); // Truck

var daf = Truck('Daf');
console.log(daf.getBrand()); // Daf
console.log(daf.getVehicleType()); // Truck

var mazda = SUV('Mazda');
console.log(mazda.getBrand()); // Mazda
console.log(mazda.getVehicleType()); // SUV

var honda = SUV('Honda');
console.log(honda.getBrand()); // Honda
console.log(honda.getVehicleType()); // SUV