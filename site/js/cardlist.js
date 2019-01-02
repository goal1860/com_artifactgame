$(document).ready(function () {

    const table = $('#cardlist').DataTable({
        lengthChange: false,
        responsive: true,
        "columnDefs": [
            {
                "targets": [ 6 ],
                "visible": false,
                "searchable": true
            }
        ]
    });
    /**
     * Code for filtering by rarity
     */
    const rarities = ['Basic', 'Common', 'Uncommon', 'Rare'];
    $('.rarity-card').on('change', function () {
        const rarity = $(this).attr('id');
        if ($('#' + rarity + ':checked').length === 0) {
            const index = rarities.indexOf(rarity)
            rarities.splice(index, 1);
        } else {
            rarities.push(rarity);
        }

        let search;
        if (rarities.length > 0) {
            search = rarities.toString().split(',').join('|');
        } else {
            search = null
        }


        table.column(4)
            .search(search, true, false, false)
            .draw();
    });
    /**
     * Code for filtering by color
     */
    const colorSet = new Set(['red', 'green', 'blue', 'black', '-']);
    $('.color-card').on('change', function () {
        var color = $(this).attr('id');
        var colorVal;
        if(color == 'nocolor'){
            colorVal = '-';
        }else {
            colorVal = color;
        }
        if ($('#' + color + ':checked').length === 0) {
            if(colorSet.has(colorVal)){
                colorSet.delete(colorVal);
            }

        } else {
            colorSet.add(colorVal);
        }

        if (colorSet.size > 0) {
            searchStr =Array.from(colorSet).toString();
            console.log(searchStr);
            search = searchStr.split(',').join('|');
        } else {
            search = null;
        }

        table.column(3)
            .search(search, true, false)
            .draw();
    });
    /**
     * Code for filtering by card type
     */
    const typeSet = new Set(['Hero', 'Spell', 'Creep', 'Improvement', 'Weapon', 'Armor', 'Accessory', 'Consumable']);
    $('.type-card').on('change', function () {
        var type = $(this).attr('id');
        if ($('#' + type + ':checked').length === 0) {
            if(typeSet.has(type)){
                typeSet.delete(type);
            }

        } else {
            typeSet.add(type);
        }

        if (typeSet.size > 0) {
            searchStr =Array.from(typeSet).toString();
            search = searchStr.split(',').join('|');
        } else {
            search = null;
        }
        // console.log(search);
        table.column(6)
            .search(search, true, false)
            .draw();
    });
});