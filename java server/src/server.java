import java.io.*;
import java.net.*;
import java.util.Scanner;

public class server {

    public static void main(String[] args) {
        try {

            ServerSocket server = new ServerSocket(5000);
            Scanner input = new Scanner(System.in);
            System.out.println("server started !");
            System.out.println("waiting for client... ");

            Socket socket = server.accept();

            System.out.println("client connected !");

            DataInputStream in = new DataInputStream(socket.getInputStream());
            DataOutputStream out = new DataOutputStream(socket.getOutputStream());

            while (true) {

                String smsg = input.nextLine();
                out.writeUTF(smsg);
                out.flush();

                System.out.println("server : " + smsg);
                if (smsg.equals("CLOSE") ) {
                    break;
                }

                String cmsg = in.readUTF();
                System.out.println("Client : " + cmsg);
                if (cmsg.equals("CLOSE")) {
                    break;
                }
            }

            input.close();
            server.close();

        } catch (Exception e) {
            e.printStackTrace();
        }
    }

}