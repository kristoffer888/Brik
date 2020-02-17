// Frederik Milling Pytlick
// frederikpyt@gmail.com
// Desc:
// The canvas javascript file
//

var zones = [];
var blobs = [];
var speed = 0.35;
var defaultZoneSize = 125;
var mult = 2;

//On start
function setup() {
  createCanvas(windowWidth, windowHeight);
  for (var i = 0; i < 6; i++) {
    zones[i] = new Zone(i);
  }

    getZoneData(1, getFromZone(1).length);
    getZoneData(2, getFromZone(2).length);
    getZoneData(3, getFromZone(3).length);
    getZoneData(4, getFromZone(4).length);
    getZoneData(5, getFromZone(5).length);
    getZoneData(6, getFromZone(6).length);

  setInterval(function() {
      getZoneData(1, getFromZone(1).length);
      getZoneData(2, getFromZone(2).length);
      getZoneData(3, getFromZone(3).length);
      getZoneData(4, getFromZone(4).length);
      getZoneData(5, getFromZone(5).length);
      getZoneData(6, getFromZone(6).length);
  }, 100);
  zones[0].init();
  zones[1].init();
  zones[2].init();
  zones[3].init();
  zones[4].init();
  zones[5].init();
}

function getZoneData(zone, amount) {
    var data = {
        "zone5":0,
        "zone6":0,
        "programmoerer":0,
        "serverrum":0,
        "helpdesk":0,
        "ekstern":0,
    };

    switch (zone) {
        case 1:
            data.zone5 = amount;
            break;
        case 2:
            data.zone6 = amount;
            break;
        case 3:
            data.programmoerer = amount;
            break;
        case 4:
            data.serverrum = amount;
            break;
        case 5:
            data.helpdesk = amount;
            break;
        case 6:
            data.ekstern = amount;
            break;
    }
    updateData(data);
}

//Retrieve zone data from database
function updateData(data) {
          var Changed0 = 0;
          var Changed1 = 0;
          var Changed2 = 0;
          var Changed3 = 0;
          var Changed4 = 0;
          var Changed5 = 0;
          
          var target = 0;
          
          if(zones[0].amountOfPeople != data.zone5){
              var target = zones[0];
              Changed0 = zones[0].amountOfPeople-data.zone5;
          }
          
          if(zones[1].amountOfPeople != data.zone6){
              var target = zones[1];
              Changed1 = zones[1].amountOfPeople-data.zone6;
          }
          
          if(zones[2].amountOfPeople != data.programmoerer){
              var target = zones[2];
              Changed2 = zones[2].amountOfPeople-data.programmoerer;
          }
          
          if(zones[3].amountOfPeople != data.serverrum){
              var target = zones[3];
              Changed3 = zones[3].amountOfPeople-data.serverrum;
          }
          
          if(zones[4].amountOfPeople != data.helpdesk){
              var target = zones[4];
              Changed4 = zones[4].amountOfPeople-data.helpdesk;
          }
          
          if(zones[5].amountOfPeople != data.ekstern){
              var target = zones[5];
              Changed5 = zones[5].amountOfPeople-data.ekstern;
          }

          if(Changed0 < 0)
            var target = zones[0];
          if(Changed1 < 0)
            var target = zones[1];
          if(Changed2 < 0)
            var target = zones[2];
          if(Changed3 < 0)
            var target = zones[3];
          if(Changed4 < 0)
            var target = zones[4];
          if(Changed5 < 0)
            var target = zones[5];
        
          zones[0].adjustSize(zones[0].amountOfPeople-data.zone5, target);
          zones[0].amountOfPeople = data.zone5;
          zones[1].adjustSize(zones[1].amountOfPeople-data.zone6, target);
          zones[1].amountOfPeople = data.zone6;
          zones[2].adjustSize(zones[2].amountOfPeople-data.programmoerer, target);
          zones[2].amountOfPeople = data.programmoerer;
          zones[3].adjustSize(zones[3].amountOfPeople-data.serverrum, target);
          zones[3].amountOfPeople = data.serverrum;
          zones[4].adjustSize(zones[4].amountOfPeople-data.helpdesk, target);
          zones[4].amountOfPeople = data.helpdesk;
          zones[5].adjustSize(zones[5].amountOfPeople-data.ekstern, target);
          zones[5].amountOfPeople = data.ekstern;
          
          if(Changed0 > 0)
            zones[0].removePeople();
          if(Changed1 > 0)
            zones[1].removePeople();
          if(Changed2 > 0)
            zones[2].removePeople();
          if(Changed3 > 0)
            zones[3].removePeople();
          if(Changed4 > 0)
            zones[4].removePeople();
          if(Changed5 > 0)
            zones[5].removePeople();
}

//Every frame
function draw() {
  background(255);

  for (var i = 0; i < zones.length; i++) {
    zones[i].show();
    for (var j = 0; j < zones.length; j++) {
      if (zones[i] === zones[j]) continue;

      if (zones[i].intersects(zones[j])) {
        //console.log(zoner[i].zone + ": Colided with " + zoner[j].zone);
        resolveCollision(zones[i], zones[j]);
      }
    }
  }
  
  for (var i = 0; i < blobs.length; i++) {
    if(blobs[i].dist < 20)
    {
        blobs[i].target.addPeople();
        blobs.splice(i,1);
    }
    else
    {
        blobs[i].show();
        blobs[i].move();
    }
  }
  
}

//Collision actions
function rotatevel(velocity, angle) {
  const rotatedVelocities = {
    x: velocity.x * Math.cos(angle) - velocity.y * Math.sin(angle),
    y: velocity.x * Math.sin(angle) + velocity.y * Math.cos(angle)
  };

  return rotatedVelocities;
}

function resolveCollision(particle, otherParticle) {
  const xVelocityDiff = particle.velocity.x - otherParticle.velocity.x;
  const yVelocityDiff = particle.velocity.y - otherParticle.velocity.y;

  const xDist = otherParticle.pos.x - particle.pos.x;
  const yDist = otherParticle.pos.y - particle.pos.y;

  // Prevent accidental overlap of particles
  if (xVelocityDiff * xDist + yVelocityDiff * yDist >= 0) {
    // Grab angle between the two colliding particles
    const angle = -Math.atan2(
      otherParticle.pos.y - particle.pos.y,
      otherParticle.pos.x - particle.pos.x
    );

    // Store mass in var for better readability in collision equation
    const m1 = particle.mass;
    const m2 = otherParticle.mass;

    // Velocity before equation
    const u1 = rotatevel(particle.velocity, angle);
    const u2 = rotatevel(otherParticle.velocity, angle);

    // Velocity after 1d collision equation
    const v1 = {
      x: (u1.x * (m1 - m2)) / (m1 + m2) + (u2.x * 2 * m2) / (m1 + m2),
      y: u1.y
    };
    const v2 = {
      x: (u2.x * (m1 - m2)) / (m1 + m2) + (u1.x * 2 * m2) / (m1 + m2),
      y: u2.y
    };

    // Final velocity after rotating axis back to original location
    const vFinal1 = rotatevel(v1, -angle);
    const vFinal2 = rotatevel(v2, -angle);

    // Swap particle velocities for realistic bounce effect
    particle.velocity.x = vFinal1.x;
    particle.velocity.y = vFinal1.y;

    otherParticle.velocity.x = vFinal2.x;
    otherParticle.velocity.y = vFinal2.y;
  }
}
