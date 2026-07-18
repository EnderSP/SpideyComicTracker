//This is main javascript file for project WebSlinger, containing code for all frontend buttons 

//button for 616 comic timeline linking homepage to trackerpage
const button616 = document.getElementById('btn_616');
button616.addEventListener('click', function() {
    window.location.href = 'Tracker.html';
});
//button for 2000s ultimate timeline
const button2000 = document.getElementById('btn_2000');
button2000.addEventListener('click', function() {
    window.location.href ='Tracker.html';
});
// button for 2018s ultimate timeline
const button2018 = document.getElementById('btn_2018');
button2018.addEventListener('click',function(){
    window.location.href="Tracker.html";

})




//code for tracker button functionality

const backButton = document.getElementById('back');
backButton.addEventListener('click',function(){
    window.location.href="SelectionScreen.html";
})





