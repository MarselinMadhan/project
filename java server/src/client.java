import java.io.*;
import java.net.*;
import java.util.*;

public class client {
    public static void main(String[] args) {
        try {
            Socket socket = new Socket("localhost", 5000);
            Scanner input = new Scanner(System.in);

            System.out.println("Connect to server!");

            DataOutputStream out = new DataOutputStream(socket.getOutputStream());
            DataInputStream in = new DataInputStream(socket.getInputStream());
            while (true) {

                String smsg = in.readUTF();
                System.out.println("server: " + smsg);
                 if (smsg.equals("CLOSE")) {
                    break;
                }
            
                String cmsg = input.nextLine();
                out.writeUTF(cmsg);
                out.flush();
                System.out.println("Client : "+ cmsg);
                if (cmsg.equals("CLOSE")) {
                    break;
                }
               

            }

            input.close();
            socket.close();

        } catch (Exception e) {
            e.printStackTrace();
        }
    }
}