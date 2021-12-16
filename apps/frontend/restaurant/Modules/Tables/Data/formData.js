
import {uuid} from "@/Modules/Shared/helpers";

export default () => {
    return {
        id: uuid(),
        code: "",
        state: "available",
        maxPeople: 0,
        minPeople: 0,
        description: "",
    }
}
