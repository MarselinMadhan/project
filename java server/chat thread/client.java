import java.io.*;
import java.net.*;

class client {
    public static void main(String[] args) {
        try {

            Socket socket = new Socket("localhost", 5000);
            System.out.println("connect to server");
            System.out.print("Enter you name : ");

            DataInputStream in = new DataInputStream(socket.getInputStream());
            DataOutputStream out = new DataOutputStream(socket.getOutputStream());

            readthread rt = new readthread(in);
            writethread wt = new writethread(out);

            rt.start();
            wt.start();
            // socket.close();

        } catch (Exception e) {
            System.out.println("Client disconnected");
            

        }
    }
}