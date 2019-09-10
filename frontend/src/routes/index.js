import { createStackNavigator,createAppContainer} from "react-navigation";
import Splash from '../screens/splash'
import Intro from "../screens/intro";
import SignIn from "../screens/signin";
import Reset from "../screens/reset";
// import SignUp from "../screens/signup2";
import SignUp2 from "../screens/signup2"
import Lobby from "../screens/lobby";
import Filter from "../screens/filter";
// import signup2 from "../screens/signup";
import SignUp from "../screens/signup"
// import EmailVerification from "../screens/emailverification";
import EmailVerification from '../screens/emailverification'
const MainAppNavigator = createStackNavigator(
    {
        Splash: Splash,
        Intro: Intro,
        SignIn: SignIn,
        Reset : Reset,
        SignUp : SignUp,
        SignUp2: SignUp2,
        Lobby : Lobby,
        Filter : Filter,
        EmailVerification : EmailVerification
    },
    {
        initialRouteName: "SignUp",
        headerMode: "none"
    }
);

export const AppContainer = createAppContainer(MainAppNavigator);