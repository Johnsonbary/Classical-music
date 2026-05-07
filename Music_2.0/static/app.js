function nextStep() {
    const role = document.getElementById("role").value;
    const form = document.getElementById("dynamicForm");

    form.innerHTML = "";
    
    if (role === "composer") {
        form.innerHTML += `
            <input name="display_name" placeholder="Nom artistique">
            <textarea name="bio" placeholder="Biographie"></textarea>
        `;
    }

    if (role === "performer") {
        form.innerHTML += `
            <input name="display_name" placeholder="Nom artistique">
            <input name="instrument" placeholder="Instrument principal">
            <textarea name="bio" placeholder="Biographie"></textarea>
        `;
    }

    if (role === "both") {
        form.innerHTML += `
            <input name="display_name" placeholder="Nom artistique">
            <input name="instrument" placeholder="Instrument principal">
            <textarea name="bio" placeholder="Biographie"></textarea>
        `;
    }

    if (role === "auditor") {
        form.innerHTML += `<p>Bienvenue 🎧 Vous êtes prêt à explorer la musique !</p>`;
    }
    form.innerHTML += `<button type="submit">Terminer</button>`;
}