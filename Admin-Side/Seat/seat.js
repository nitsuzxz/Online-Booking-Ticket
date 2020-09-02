
    const container = document.querySelector('.container');

    
    // Seat select event
    container.addEventListener('click', e => {
        if (
            e.target.classList.contains('seat') &&
            !e.target.classList.contains('occupied')
        ) {
            e.target.classList.toggle('selected');

            updateSelectedSeats();
        }
    });

    const updateSelectedSeats = () => {
        
        const selectedSeatNum= document.querySelectorAll('.row .selected');
        
        for(let i=0; i< selectedSeatNum.length;i++){
 
            console.log("index"+i+".  SEAT NUMBER="+ selectedSeatNum[i].innerText);
     
        }
      
    };