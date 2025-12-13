enum SkillType {
  STRENGTH = "strength",
  SPEED = "speed",
  MAGIC = "magic"
}

interface CharacterSkills {
  strength: number;
  speed: number;
  magic: number;
}
class Character implements CharacterSkills {
  private readonly MAX_POINTS = 20;
  private readonly BASE_POINTS = 15;

  public level: number = 1;
  public message: string = "";

  constructor(
    public strength: number,
    public speed: number,
    public magic: number
  ) {}

  private totalPoints(): number {
    return this.strength + this.speed + this.magic;
  }

  private updateLevel(): void {
    const extraPoints = this.totalPoints() - this.BASE_POINTS;
    this.level = Math.max(1, 1 + Math.floor(extraPoints / 2));
  }

  increase(skill: SkillType): void {
    if (this.totalPoints() >= this.MAX_POINTS) {
      this.message = "⚠️ No more points available";
      return;
    }

    this[skill]++;
    this.message = `✅ Increased ${skill}`;
    this.updateLevel();
  }

  decrease(skill: SkillType): void {
    if (this[skill] <= 0) {
      this.message = "⚠️ Skill cannot go below 0";
      return;
    }

    this[skill]--;
    this.message = `➖ Decreased ${skill}`;
    this.updateLevel();
  }

  reset(): void {
    this.strength = 5;
    this.speed = 5;
    this.magic = 5;
    this.level = 1;
    this.message = "🔄 Skills reset";
  }
}

const character = new Character(5, 5, 5);

function updateUI(): void {
  (globalThis as any).document.getElementById("status").innerHTML =
    `Level: ${character.level}<br>` +
    `Strength: ${character.strength} | ` +
    `Speed: ${character.speed} | ` +
    `Magic: ${character.magic}<br>` +
    `<small>${character.message}</small>`;
}

(globalThis as any).document
  .querySelectorAll("button")
  .forEach((btn: any) => {
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
