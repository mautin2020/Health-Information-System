function is_valid_state($state) {
    $validStates = array("Abia", "Abuja", "Adamawa", "Akwa-Ibom", "Anambra", "Bauchi", "Bayelsa", "Benue", "Borno", 
        "Cross-River", "Delta", "Ebonyi", "Edo", "Ekiti",  "Enugu", "Gombe", "Imo", "Jigawa", "Kaduna", "Kano",
        "Kastina", "Kebbi", "Kogi", "Kwara", "Lagos", "Nassarawa", "Niger", "Ogun", "Ondo", "Osun", "Oyo", "Plateu", "River", "Sokoto", "Taraba",
        "Yobe", "Zamfara");
        if (in_array($state,$validStates)) {
            return true;
        } else {
            return false;
        }
} // end of function is_valid_state 

// valid gender 

function is_valid_gender($gender) {
    $validGender = array("Male", "Female");
    if(in_array($gender,$validgender)) {
        return true;
    } else {
        return false;
    }
}