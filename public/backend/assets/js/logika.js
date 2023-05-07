const X = [
    [3, 15, 40],
    [3, 54, 63],
    [3, 78, 69],
    [3, 31, 41],
    [3, 47, 51]
    ];
    
    const w = [0.5, 0.3, 0.2];
    
    // Normalize matrix X
    const C1 = X.reduce((acc, curr) => acc + curr[0], 0);
    const C2 = X.reduce((acc, curr) => acc + curr[1], 0);
    const C3 = X.reduce((acc, curr) => acc + curr[2], 0);
    
    const A = X.map(([x1, x2, x3]) => [
    x1 / C1,
    x2 / C2,
    x3 / C3,
    ]);
    
    // Apply weight to matrix A
    const AW = A.map(([a1, a2, a3]) => [
    a1 * w[0],
    a2 * w[1],
    a3 * w[2],
    ]);
    
    // Calculate S+ and S-
    const Splus = [];
    
    AW.map((row) => {
      const sum = row[0] + row[1];
      Splus.push(sum);
    });
    
    console.log(AW);
    
    const Sminus = AW.map(([a1, a2, a3]) => a3);
    
    // Inverse S-
    const SminusInv = Sminus.map(data => 1/data);
    
    const total = SminusInv.reduce((acc, cur) => {return acc+cur} );
    
    
    resultSminus = Sminus.map((data, i) => {
        
        // return{
        //     index: i,
        //     value: data*total
        // };
        return data*total;
    });
    // resultSminus.forEach(function(value, key){
    //   console.log(value.value);
    // });
    // Sort the result descendingly by value
    // resultSminus.sort((a, b) => b.value - a.value);
    
    // Qi = Splus.map((data, i) => {
    //     resultSminus.forEach(function(value, key){
    //         console.log(value.value);
    //     });
    // });
    
    let Qi = [];
    for (let i = 0; i < resultSminus.length; i++) {
      Qi[i] = Splus[i] + (0.1 / resultSminus[i]); // ganti 0.1 dengan 
    }
    const maxQi = Math.max(...Qi);
    
    const Ui = Qi.map((data, i) => {
        return{
            index: i,
            value: (data/maxQi)*100
        };
    });
    // Sort the Ui descendingly by value
    Ui.sort((a, b) => b.value - a.value);
    
    // Print the result
    // console.log(Qi);
    // console.log(maxQi);
    console.log(Ui);
    
    