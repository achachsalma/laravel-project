import './bootstrap';

const getNumber = () => {
    const randomNumber = Math.floor(Math.random() * 17);
    return randomNumber;
}

const getColor = () => {
    const colorPattern = [
        '#18B7BE', '178CA4', '#072A40', '#F3D849', '#0A62D0', '#191718', '#F21137', '#68010F', '#5BFF33',
        '#FFFF33', '#FFB733', '#33FFD2', '#3e58ec', '#ff3232', '#00ffff', '##FB33FF', '#3733FF'
    ]
    document.querySelectorAll('.grid_items').forEach((item) => {
        item.style.borderColor = colorPattern[getNumber()];
    });
}

getColor();