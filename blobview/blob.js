// Frederik Milling Pytlick
// frederikpyt@gmail.com
// Desc:
// Blob is the small ellipses that get instantiated on top of zones when a user leaves the zone for another one.
// They have a target coordinate they try to reach and when reached they disappear.

function Blob(x, y, r, color, targetZone) {
  this.pos = createVector(x, y);
  this.r = r;
  this.target = targetZone;
  this.targetZone = createVector(targetZone.pos.x, targetZone.pos.y);
  this.color = color;
  this.dist = dist(this.pos.x, this.pos.y, this.targetZone.x, this.targetZone.y);

  this.move = function() {
    this.targetZone = createVector(targetZone.pos.x, targetZone.pos.y);
    this.dist = dist(this.pos.x, this.pos.y, this.targetZone.x, this.targetZone.y);
    this.targetZone.sub(this.pos);
    this.targetZone.setMag(3);
    this.pos.add(this.targetZone);
  }
  
  this.show = function() {
    fill(this.color);
    ellipse(this.pos.x, this.pos.y, this.r*2, this.r*2);
  }
}