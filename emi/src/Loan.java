import javax.swing.table.DefaultTableModel;

public class Loan {
    double loane;
    double interest;
    int month;
    double monthly_rate;
    double ppaid;
   private double emi;
    double current_rate;
    private  double total_interest ;
     private double total_payment ;


    Loan(double loan,double interest,int month){

        this.loane = loan;
        this.interest = interest;
        this.month = month;
        monthly_rate = interest/12/100;
        emi = calemi();
    }
    public void Calculate(DefaultTableModel model){

        model.setRowCount(0);
        total_interest = 0;
        total_payment = 0;
        for(int i=1;i<=month && loane>0;i++){
            current_rate = loane * monthly_rate;
            ppaid = emi - current_rate;
            loane = loane - ppaid;
            model.addRow(new Object[]{
                i,
                String.format("₹%,.2f",current_rate),
                String.format("₹%,.2f",ppaid),
                String.format("₹%,.2f",loane)
            });
             total_interest = total_interest + current_rate;
             total_payment = total_payment + (current_rate + ppaid);
            

        }
    }

    public  double gettotal_interest(){
         return total_interest;
    }
    public  double gettotal_payment(){
        return total_payment;
    }
    public double getemi(){
        return emi;
    }

    

    public double calemi(){
        monthly_rate = interest/12/100;
        double power = Math.pow(1+monthly_rate,month);
        double numerator = loane*monthly_rate*power;
        double denominator = power - 1;
        emi = numerator/denominator;
        return emi; 
    }
}
