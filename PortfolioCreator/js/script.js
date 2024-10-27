document.getElementById('portfolioForm').addEventListener('submit', function (e) {
    let form = e.target;
    let name = document.getElementById('name').value;
    let bio = document.getElementById('bio').value;
    let skills = document.getElementById('skills').value;
    let projects = document.getElementById('projects').value;

    if (!name || !bio || !skills || !projects) {
        alert("Please fill out all the fields.");
        e.preventDefault();
    } else {
        alert("Your portfolio is being created...");
    }
});
