
import {uuid} from "@/Modules/Shared/helpers";

export default () => {
    return {
        id: uuid(),
        code: 0,
        maxPeople: 0,
        minPeople: 0,
        description: "",
    }
}
