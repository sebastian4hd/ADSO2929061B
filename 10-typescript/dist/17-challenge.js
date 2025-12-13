"use strict";
var SkillType;
(function (SkillType) {
    SkillType["STRENGTH"] = "strength";
    SkillType["SPEED"] = "speed";
    SkillType["MAGIC"] = "magic";
})(SkillType || (SkillType = {}));
class Character {
    constructor(strength, speed, magic) {
        this.strength = strength;
        this.speed = speed;
        this.magic = magic;
        this.MAX_POINTS = 20;
        this.BASE_POINTS = 15;
        this.level = 1;
        this.message = "";
    }
    totalPoints() {
        return this.strength + this.speed + this.magic;
    }
    updateLevel() {
        const extraPoints = this.totalPoints() - this.BASE_POINTS;
        this.level = Math.max(1, 1 + Math.floor(extraPoints / 2));
    }
    increase(skill) {
        if (this.totalPoints() >= this.MAX_POINTS) {
            this.message = "⚠️ No more points available";
            return;
        }
        this[skill]++;
        this.message = `✅ Increased ${skill}`;
        this.updateLevel();
    }
    decrease(skill) {
        if (this[skill] <= 0) {
            this.message = "⚠️ Skill cannot go below 0";
            return;
        }
        this[skill]--;
        this.message = `➖ Decreased ${skill}`;
        this.updateLevel();
    }
    reset() {
        this.strength = 5;
        this.speed = 5;
        this.magic = 5;
        this.level = 1;
        this.message = "🔄 Skills reset";
    }
}
const character = new Character(5, 5, 5);
function updateUI() {
    globalThis.document.getElementById("status").innerHTML =
        `Level: ${character.level}<br>` +
            `Strength: ${character.strength} | ` +
            `Speed: ${character.speed} | ` +
            `Magic: ${character.magic}<br>` +
            `<small>${character.message}</small>`;
}
globalThis.document
    .querySelectorAll("button")
    .forEach((btn) => {
    btn.addEventListener("click", () => {
        const action = btn.getAttribute("data-skill");
        switch (action) {
            case "strength":
                character.increase(SkillType.STRENGTH);
                break;
            case "speed":
                character.increase(SkillType.SPEED);
                break;
            case "magic":
                character.increase(SkillType.MAGIC);
                break;
            case "strength-dec":
                character.decrease(SkillType.STRENGTH);
                break;
            case "speed-dec":
                character.decrease(SkillType.SPEED);
                break;
            case "magic-dec":
                character.decrease(SkillType.MAGIC);
                break;
        }
        if (btn.id === "reset") {
            character.reset();
        }
        updateUI();
    });
});
updateUI();
