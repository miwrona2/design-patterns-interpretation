class Car {
  constructor(brand, model, vin) {
    this.brand = brand;
    this.model = model;
    this.vin = vin;
  }
  
  showCar() {
    return `${this.brand} ${this.model), vin: ${this.vin}`;
  } 
}

const car = new Car('Hyundai', 'Sonata', 'LA2J4188372Z29');

console.log(car.brand); // "Hyundai"
console.log(car.showCar()); // "Hyundai Sonata, vin: LA2J4188372Z29"
console.log(typeof car); // function

/* Classes are only the syntactic sugar, we can receive the same effect without them (ES5 and less): */

function Car(brand, model, vin) {
  this.brand = brand;
  this.model = model;
  this.vin = vin;
  
  this.showCar = () => {
    return `${this.brand} ${this.model), vin: ${this.vin}`;
  }
}

const car = new Car('Hyundai', 'Sonata', 'LA2J4188372Z29');

console.log(car.brand); // "Hyundai"
console.log(car.showCar()); // "Hyundai Sonata, vin: LA2J4188372Z29"
