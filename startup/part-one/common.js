$(document).ready(function(){
    $('.sidenav').sidenav();
 });

$(".dropdown-trigger").dropdown();

$(document).ready(function(){
    $('.carousel').carousel();
  });


  
function get1(){
    
  const target = document.querySelectorAll('.carousel')[0];
  function handleIntersection(entries) {
    entries.map((entry) => {
      if (entry.isIntersecting) {
        entry.target.style.opacity = '1'
        document.getElementById("car1").style.transform ="translateX(0)" 
        document.getElementById("car3").style.transform ="translateX(0)" 
      } 
    });
    
  }
  const options = {
      threshold: 0.5,
    }
  const observer = new IntersectionObserver(handleIntersection,options);
  
  observer.observe(target);
  

}


function get(){
    const newtarget = document.querySelectorAll('.row1')[0];
    function handleIntersection(entries) {
      entries.map((entry) => {
        if (entry.isIntersecting) {
          document.getElementsByClassName("imgcont")[0].style.transform ="translateX(0)" 
          document.getElementsByClassName("imgcont")[0].style.opacity ="1"
          document.getElementsByClassName("imgcont")[1].style.transform ="translateX(0)" 
          document.getElementsByClassName("imgcont")[1].style.opacity ="1" 
          setTimeout(() => {
            document.getElementsByClassName("textcont")[0].style.transform ="translateX(0)" 
          document.getElementsByClassName("textcont")[0].style.opacity ="1" 
          document.getElementsByClassName("textcont")[1].style.transform ="translateX(0)" 
          document.getElementsByClassName("textcont")[1].style.opacity ="1" 
          }, 500);
          
          
         
        } 
      });
      
    }
    const newoptions = {
        threshold: 0.3,
      }
    const observer = new IntersectionObserver(handleIntersection,newoptions);
    
    observer.observe(newtarget);
    
}
function ourteam1(){
    for (let i = 0; i < document.getElementsByClassName("writeups").length; i++) {
        const element = document.getElementsByClassName("writeups")[i];
        element.style.opacity = '0'

    }

    document.getElementsByClassName('writeups')[0].style.opacity = '1'

}


function ourteam(x){
  for (let i = 0; i < document.getElementsByClassName("writeups").length; i++) {
      const element = document.getElementsByClassName("writeups")[i];
      element.style.opacity = '0'
}

for (let j = 0; j < document.getElementsByClassName("face").length; j++) {
  const element = document.getElementsByClassName("face")[j];
  element.style.opacity = "0.5"
  
}

  document.getElementsByClassName('writeups')[x+1].style.opacity = '1'
  document.getElementsByClassName('face')[x].style.opacity = '1'
}


var i = 0;
var career = 'CAREERS';
var team = 'OUR TEAM';
var mission = 'OUR MISSION';
var Default = 'Default';
var speed = 40;
t1 = 0
t2 = 0
t3 = 0
function get4(){
  const newtarget = document.querySelectorAll('.screen')[0];
  function handleIntersection(entries) {
    entries.map((entry) => {
      if (entry.isIntersecting && t1 == 0) {
        
        function typeWriter(){
          t1++
          if (i < mission.length) {
          
            document.getElementById("mission").innerHTML = document.getElementById("mission").innerHTML + mission.charAt(i);
            i++;
            setTimeout(typeWriter, speed);
          }
          setTimeout(() => {
            document.getElementsByClassName("scont")[0].style.opacity = "1"
          }, speed*mission.length + 200);
        }
        typeWriter();

      } 
    });
    
  }
  const newoptions = {
      threshold: 0.4,
    }
  const observer = new IntersectionObserver(handleIntersection,newoptions);
  
  observer.observe(newtarget);
  
}
function get41(){
  const newtarget = document.querySelectorAll('.screen')[1];
  function handleIntersection(entries) {
    entries.map((entry) => {
      if (entry.isIntersecting && t2 == 0) {
        i=0
        t2++
        function typeWriter(){
          if (i < Default.length) {
            document.getElementById("teaam").innerHTML = document.getElementById("teaam").innerHTML + Default.charAt(i);
            i++;
            setTimeout(typeWriter, speed);
          }
          
        }
        typeWriter();
        setTimeout(() => {
          document.getElementById("team2").style.opacity = "1"
        }, speed*Default.length);
        for (let i = 0; i < document.getElementsByClassName("face").length; i++) {
          setTimeout(() => {
          const element = document.getElementsByClassName("face")[i];
          element.style.transform = "scale(1)"
          element.style.opacity = "1"
          }, speed*Default.length + 300 + 20*i);
          
        }
      } 
    });
    
  }
  const newoptions = {
      threshold: 0.8,
    }
  const observer = new IntersectionObserver(handleIntersection,newoptions);
  
  observer.observe(newtarget);
  
}
function get42(){
  const newtarget = document.querySelectorAll('.screen')[2];
  function handleIntersection(entries) {
    entries.map((entry) => {
      if (entry.isIntersecting && t3 == 0) {
        i=0
        t3++
        function typeWriter(){
          if (i < career.length) {
            document.getElementById("career").innerHTML = document.getElementById("career").innerHTML + career.charAt(i);
            i++;
            setTimeout(typeWriter, speed);
          }
          
        }
        typeWriter();
        setTimeout(() => {
          document.getElementById("caree").style.opacity = "1"
        }, speed*Default.length);
        
      } 
    });
    
  }
  const newoptions = {
      threshold: 0.8,
    }
  const observer = new IntersectionObserver(handleIntersection,newoptions);
  
  observer.observe(newtarget);
  
}

