const updatePrices = () => {

    let price, old_evolution;

    const variation = (Math.random() * 6) - 3; // [-3, 3]

    let evolution = old_evolution + variation;

    evolution = Math.max(-10, Math.min(10, evolution));

    let p = price * (1 + evolution / 100);

    p = Math.max(1, p);

    return {
        price: Math.round(p * 100) / 100,
        evolution: Math.round(evolution * 100) / 100
    };
}