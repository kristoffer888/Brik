function Zone(id) {
  switch (id) {
    case 0:
      this.zone = "Zone 5";
      this.color = color(0, 155, 255);
      break;
    case 1:
      this.zone = "Zone 6";
      this.color = color(110, 200, 255);
      break;
    case 2:
      this.zone = "Programmører";
      this.color = color(255, 190, 0);
      break;
    case 3:
      this.zone = "Serverrum";
      this.color = color(100, 200, 255);
      break;
    case 4:
      this.zone = "Helpdesk";
      this.color = color(130, 230, 255);
      break;
    case 5:
      this.zone = "Ekstern";
      this.color = color(180, 0, 210);
      break;
  }
  this.amountOfPeople = 0;
  this.amountOfPeopleReal = 0;
  this.velocity = createVector(0,0);
  this.mass = defaultZoneSize+this.amountOfPeople*2;
  this.id = id;
  
  this.init = function () {
    this.r = defaultZoneSize + (this.amountOfPeople - 10) * mult;
    switch (this.id) {
      case 0:
        this.pos = createVector(this.r + 2, this.r + 2);
        break;
      case 1:
        this.pos = createVector(this.r + 2, height - this.r - 2);
        break;
      case 2:
        this.pos = createVector(width - this.r - 2, height - this.r - 2);
        break;
      case 3:
        this.pos = createVector(width - this.r - 2,  this.r + 2);
        break;
      case 4:
        this.pos = createVector(width / 2, height - this.r - 2);
        break;
      case 5:
        this.pos = createVector(width / 2, 0 + this.r + 2);
        break;
    }
  }

  this.show = function() {
    //Invisible walls
    if(this.pos.x - this.r <= 0 || this.pos.x + this.r >= width)
      this.velocity.x = -this.velocity.x;
    if(this.pos.y - this.r <= 0 || this.pos.y + this.r >= height)
      this.velocity.y = -this.velocity.y;
    
    //Speed limiter
    if(this.velocity.x > 2)
      this.velocity.x = 2;
    if(this.velocity.x < -2)
      this.velocity.x = -2;
    if(this.velocity.y > 2)
      this.velocity.y = 2;
    if(this.velocity.y < -2)
      this.velocity.y = -2;
    
    //Move
    this.pos.x += this.velocity.x;
    this.pos.y += this.velocity.y;

    //Stop zones loosing all velocity
    if(this.velocity.x == 0 && this.velocity.y == 0) {
      var target = createVector(width/2, height/2);
      target.sub(this.pos);
      target.setMag(3);
      target.mult(speed);
      this.velocity.add(target);
    }
    
    //Draw ellipse
    fill(this.color);
    ellipse(this.pos.x, this.pos.y, this.r * 2, this.r * 2);
    
    //Draw zone name
    fill(255);
    textSize(this.r * 0.25);
    textAlign(CENTER);
    text(this.zone, this.pos.x, this.pos.y);
    
    //Draw amount of people
    fill(255);
    textSize(this.r * 0.2);
    textAlign(CENTER);
    text(this.amountOfPeople.toString(), this.pos.x, this.pos.y + this.r*0.25);
  }

  this.intersects = function(other) {
    var d = dist(this.pos.x, this.pos.y, other.pos.x, other.pos.y);
    if (d < this.r + other.r) {
      return true;
    } else {
      return false;
    }
  }
  
  this.adjustSize = function(antal_Blobs, targetZone) {
      for(var i = 0; i < antal_Blobs; i++){
          //Lave ny bobel med et mål
          blobs.push(new Blob(this.pos.x, this.pos.y, 25, this.color, targetZone));
      }
  }
  
  this.addPeople = function() {
      this.pos.x += (defaultZoneSize + (this.amountOfPeople - 10) * mult) - this.r;
      this.pos.y += (defaultZoneSize + (this.amountOfPeople - 10) * mult) - this.r;
      this.r = defaultZoneSize + (this.amountOfPeople - 10) * mult;
  }
  this.removePeople = function() {
      this.r = defaultZoneSize + (this.amountOfPeople - 10) * mult;
  }
}