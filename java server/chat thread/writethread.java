import java.io.DataOutputStream;
import java.util.*;

public class writethread extends Thread {
    DataOutputStream out;
    Scanner input = new Scanner(System.in);

    writethread(DataOutputStream out) {
        this.out = out;
       
    }

    public void run() {
        try {
            while (true) {
                String msg = input.nextLine();
                out.writeUTF(msg);
                out.flush();
                if (msg.equals("/EXIT")) {
                    System.out.println(" Disconnected");
                    break;
                }

            }

        } catch (Exception e) {
            System.out.println("write exception");
        }

    }
}
