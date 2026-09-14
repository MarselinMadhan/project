import java.io.DataInputStream;

public class readthread extends Thread {
    DataInputStream in;
    

    readthread(DataInputStream in  ) {
        this.in = in;
        
    }

    public void run() {
        try {

            while (true) {
                String msg = in.readUTF();
                System.out.println(msg);
                if (msg.equals("/EXIT")) {
                    System.out.println("Disconnected");
                    break;
                    
                }

            }

        } catch (Exception e) {
            System.out.println("You cant msg here");
        }

    }

}
